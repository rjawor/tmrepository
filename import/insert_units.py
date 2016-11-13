#!/usr/bin/python
# -*- coding: utf-8 -*-

import sys, MySQLdb

tm_id = sys.argv[1]
src_path = sys.argv[2]
trg_path = sys.argv[3]

db = MySQLdb.connect("localhost","tmuser","tmuser","tmrepository" )
db.set_character_set('utf8')


cursor = db.cursor()
cursor.execute('SET NAMES utf8;')
cursor.execute('SET CHARACTER SET utf8;')
cursor.execute('SET character_set_connection=utf8;')


with open(src_path, 'r') as src_file, open(trg_path, 'r') as trg_file:
	for src_line in src_file:
		src_line = src_line.strip()
		trg_line = trg_file.readline().strip()
		cursor.execute("INSERT INTO units(translation_memory_id, source_segment, target_segment) VALUES (%s,%s,%s)", (tm_id, src_line, trg_line))

db.commit()
db.close()
