#!/usr/bin/python
# encoding: utf-8
from sklearn.cluster import KMeans
import numpy as np
import pandas as pd

# entire database with name, email and responses
data = pd.read_csv('dataset.txt', header=None)

# copying database 
data_without_info = data.copy()

# database without name and email
data_without_info.drop(data_without_info.columns[[13, 14, 15]], axis=1, inplace=True) 

# one hot enconding
data_without_info = pd.get_dummies(data_without_info)

# new data inserted
new_data = data_without_info.tail(1)

# delete last row
data_without_info = data_without_info.head(data_without_info.shape[0] -1)

# creating and running KMeans model 
kmeans = KMeans(n_clusters=5, random_state=0).fit(data_without_info)

# predicting the cluster of the user
nd_cluster = kmeans.predict(new_data)

# html table output
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
for i in range(len(kmeans.labels_)):	
	if kmeans.labels_[i] == nd_cluster:
		# html table output
		print("<tr><td>")
		print(data.iloc[i][13])
		print("</td><td>")
		print(data.iloc[i][14])
		print("</td><td>")
		print(data.iloc[i][15])
		print("</td></tr>")
		count = count + 1
i = i + 1
count = count + 1

# html table output
print("<tr><td>")
print(data.iloc[i][13])
print("</td><td>")
print(data.iloc[i][14])
print("</td><td>")
print(data.iloc[i][15])
print("</td></tr>")
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
