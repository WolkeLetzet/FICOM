import xmltodict
import json
import os
import sys
import csv

path=os.path.dirname(os.path.realpath(__file__))
xml_path = sys.argv[1]
json_path = path+"/nomina.json"
with open(xml_path,'r',encoding="utf-8-sig",errors='replace') as fp:
   xml = fp.read()
   dictionary = xmltodict.parse(xml)
   fp.close()

with open(json_path,"w",encoding="utf-8-sig") as of:
   json.dump(dictionary,of,indent=3) 
   fp.close()
 

   
