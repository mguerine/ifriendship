#!/usr/bin/python
# encoding: utf-8
from sklearn.cluster import KMeans
import numpy as np

def readcsv2(filename):
	with open(filename) as f:
		b = []
		for line in f:
			sp = line.split(';');
			a = []	
			resp1 = sp[0]
			resp2 = sp[1]
			resp3 = sp[2]
			resp4 = sp[3]
			resp5 = sp[4]
			resp6 = sp[5]
			resp7 = sp[6]
			resp8 = sp[7]
			resp9 = sp[8]
			resp10 = sp[9]
			resp11 = sp[10]
			resp12 = sp[11]
			resp13 = sp[12]
			resp1 = (float(resp1) - 1)/(11)
			resp2 = (float(resp2) - 1)/(6)
			resp3 = (float(resp3) - 1)/(7)
			resp4 = (float(resp4) - 1)/(6)
			resp5 = (float(resp5) - 1)/(4)
			resp6 = (float(resp6) - 1)/(5)
			resp7 = (float(resp7) - 1)/(5)
			resp8 = (float(resp8) - 1)/(6)
			resp9 = (float(resp9) - 1)/(4)
			resp10 = (float(resp10) - 1)/(10)
			resp11 = (float(resp11) - 1)/(5)
			resp12 = (float(resp12) - 1)/(5)
			resp13 = (float(resp13) - 1)/(8)
			nome = sp[13]
			email = sp[14]
			turma = sp[15]
			print resp1, ";",resp2, ";",resp3, ";",resp4, ";",resp5, ";",resp6, ";",resp7, ";",resp8, ";",resp9, ";",resp10, ";",resp11, ";",resp12, ";",resp13, ";", nome, ";", email, ";", turma
						
			for pal in sp:
				a.append(pal)
				
			b.append(a)
	return b

a = readcsv2("ifriends.csv")
