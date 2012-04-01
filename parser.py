#Парсим таблицу с сайта http://mostransavto.ru/?page=rasp&code=-1546379448&ak=7&n=368 и результат
#выводим в файл testout.sql который ОБЯЗАН находиться в той же папке, что и скрипт.


import re
import time
import urllib.request as ur
fd=open("test", mode='w', encoding='utf-8')
def temp(f):
	s1=time.time()
	f
	s2=time.time()
	print("Time=", s2-s1)

url=ur.urlopen("http://www.mostransavto.ru/?page=rasp&code=-1546379448&ak=7&n=368&com=1")
f=url.read().decode("cp1251")
fd1=open("Речнойвокзал", 'w', encoding='utf-8')
print(f, file=fd1)
"""
#---------------------------------------
regular=r"[0-9]{2}:[0-9]{2}"
pat1=re.compile(regular)
regular2=r"Речной вокзал|Долгопрудная|(?:[0-9]{2}:[0-9]{2}){1}|(?:[0-9]{2}:[0-9]{2}){10}"
regular4="Речной вокзал.{1,400}</td></tr>|Долгопрудная.{1,400}</td></tr>"
pat2=re.compile(regular2, re.DOTALL)
pat4=re.compile(regular4, re.DOTALL)
temp=pat4.findall(f)
o=0
pair=1
r=[{}]*2000
r_dr=[{}]*2000
r_rd=[{}]*2000

for l in temp:
	l=l[0:len(l)-1]
	l=pat2.findall(l)
	for t in l:
		print(t)
	"""
"""
	if len(l)==11:
		d=dict({"place":l[0], "пвсчп":[l[2],l[4], l[5], l[7], l[9]], "св":[l[1],l[6],l[3],l[8], l[10]]})
		r[o]=dict(d)
	elif len(l)==2:
		d=dict({"place":l[0], "пвсчп":[l[1],l[6]], "св":[l[2],l[3],l[5]], "пвсчпсв":[l[4],l[7],l[8]]})
		r[o]=dict(d)
	o=o+1
for o in r:
	print(o)
"""
"""
for o in range(2000):
	if r[o]!={}:
		if r[o].get("place")==r[o-1].get("place"):
			r_dr=r[:o]
			r_rd=r[o:]
			break


#--------------------------------------------
fd=open("testout.sql", 'w', encoding='utf-8')
s='insert into main(reis_name, reis_number, start_date, end_date, type_of_day, type_of_reis) values('
for o in range(len(r_dr)):
	s1=s+'"Долгопрудный-Речной вокзал", "368",'
	if r_dr[o].get('place')=='Речной вокзал':
		de1={key: ['"'+r_dr[o-1].get(key)[i]+'","'+r_dr[o].get(key)[i]+'"' for i in range(len(r_dr[o].get(key))-1)] for key in r_dr[o].keys() if key!='place'}
		for key in de1.keys():
			if key!='place':
				for e in de1.get(key):
					print(s1+e+','+'"'+key+'"'+',1'+');', file=fd)


for o in range(len(r_rd)):
	s1=s+'"Речной вокзал-Долгопрудная", "368",'
	if r_rd[o].get('place')=='Долгопрудная':
		de1={key: ['"'+r_rd[o-1].get(key)[i]+'","'+r_rd[o].get(key)[i]+'"' for i in range(len(r_rd[o].get(key))-1)] for key in r_rd[o].keys() if key!='place'}
		for key in de1.keys():
			if key!='place':
				for e in de1.get(key):
					print(s1+e+','+'"'+key+'"'+',-1'+');', file=fd)

"""
