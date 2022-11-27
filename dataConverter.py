import xmltodict
import json
import codecs
import csv

def formatter(data :dict):
   curso


path = "./nomina_XML.xml"
with codecs.open(path,'r',encoding="utf-8-sig") as fp:
   xml = fp.read()
   dictionary = xmltodict.parse(xml)
   fp.close()
   
with open("nomina.json","w",encoding="utf-8-sig") as of:
   json.dump(dictionary,of,indent=3) 
   fp.close()
 
   
   
