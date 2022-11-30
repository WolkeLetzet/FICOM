import xmltodict
from os import getenv as env
from dotenv import load_dotenv
import mysql.connector
import os
import sys

def formatter(data):
   alumnos =[];
   for curso in data['mineduc']['nomina_establecimieno']['tipo_ensenanza']['curso']:
      grado= curso['@grado']
      letra = curso['@letra']
      for alumno in curso['alumno']:
         if alumno["@email"].strip()=="" : alumno["@email"]=None
         alumnos.append({
               "grado":grado,
               "letra":letra,
               "run": alumno["@run"]+alumno["@digito_ve"],
               "apellidos":alumno['@ape_paterno']+" "+ alumno['@ape_materno'],
               "nombres":alumno['@nombres'],
               "direccion":alumno["@direccion"],
               "telefono":alumno["@telefono"],
               "email":alumno["@email"],
               
            })
         
   return alumnos;

def dataCharge(data:list[dict]):
   mydb = mysql.connector.connect(
      host=env("DB_HOST"),
      user=env("DB_USERNAME"),
      password=env("DB_PASSWORD"),
      database=env("DB_DATABASE")
   )

   cursor= mydb.cursor()
   cursor.execute("Drop Table If exists ficom.temp;")
   cursor.execute(
      """Create Table ficom.temp(
         apellidos varchar(255) COLLATE 'utf8mb4_unicode_ci',
         direccion varchar(255) COLLATE 'utf8mb4_unicode_ci',
         email varchar(255) COLLATE 'utf8mb4_unicode_ci',
         grado varchar(255) COLLATE 'utf8mb4_unicode_ci',
         letra varchar(255) COLLATE 'utf8mb4_unicode_ci',
         nombres varchar(255) COLLATE 'utf8mb4_unicode_ci',
         run varchar(255) COLLATE 'utf8mb4_unicode_ci',
         telefono varchar(255) COLLATE 'utf8mb4_unicode_ci');"""
   )
   cursor.executemany("""
      INSERT  INTO ficom.temp(apellidos, direccion,email,grado,letra,nombres,run,telefono)
      VALUES (%(apellidos)s, %(direccion)s,%(email)s,%(grado)s,%(letra)s,%(nombres)s,%(run)s,%(telefono)s );""",
      data
   )
   mydb.commit() 
   cursor.execute(
      """INSERT IGNORE  INTO ficom.estudiantes (apellidos,nombres,rut,email_institucional ,telefono,direccion,curso_id)
         SELECT tmp.apellidos, tmp.nombres, tmp.run, tmp.email, tmp.telefono, tmp.direccion, crs.id AS curso
         FROM ficom.temp AS tmp
         INNER JOIN ficom.cursos AS crs
         ON (crs.curso = tmp.grado ) AND (crs.paralelo = tmp.letra)"""
   )
   mydb.commit() 
   #cursor.execute("Drop Table If exists ficom.temp;")
   mydb.close()

load_dotenv()
path=os.path.dirname(os.path.realpath(__file__))
xml_path = sys.argv[1]
with open(xml_path,'r',encoding="utf-8-sig",errors='replace') as fp:
   xml = fp.read()
   dictionary = xmltodict.parse(xml)
   fp.close()
dataCharge(formatter(dictionary))


   
