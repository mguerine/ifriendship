#!/usr/bin/python
from sklearn.cluster import KMeans
import numpy as np
import csv

# read data from database CSV file
def readcsv(filename):	
    ifile = open(filename, "rU")
    reader = csv.reader(ifile, delimiter=";")

    rownum = 0	
    a = []

    for row in reader:
        a.append (row)
        rownum += 1
    
    ifile.close()
    return a

# entire database with name, email and class
data = readcsv('dataset.txt')


data_without_info = []

# get data into KMeans format
for items in data:
    data_without_info.append(items[0:13])

# creating and running KMeans model 
kmeans = KMeans(n_clusters=3, random_state=0).fit(data_without_info)
#print(kmeans.labels_)

# predicting the cluster of the user
new_data = []
new_data.append(data_without_info[-1])
nd_cluster = kmeans.predict(new_data)


print("<div class=\"table-wrapper\">")
print("<table>")
print("<thead>")
print("<tr>")
print("<th>Nome</th>")
print("<th>E-mail</th>")
print("<th>Turma</th>")
print("</tr>")
print("</thead>")

print("<tbody>")
# creating html table for showing the results
data_info = []

# printing user's new friends
i = 0
count = 0
for elem in data:
	
	if kmeans.labels_[i] == nd_cluster:
		print("<tr><td>")
		print(data[i][13])
		print("</td>")
		print("<td>")
		print(data[i][14])
		print("</td>")
		print("<td>")
		print(data[i][15])
		print("</td></tr>")
		count = count + 1
	i = i + 1
print("</tbody>")
print("<tfoot>")
print("<tr>")
print("<td colspan=\"2\"><strong>Total</strong>: </td>")
print("<td><strong>")
print(count)
print("</strong></td>")
print("</tr>")
print("</tfoot>")
print("</table>")
print("</div>")
