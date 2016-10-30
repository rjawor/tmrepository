#!/usr/bin/python
# -*- coding: utf-8 -*-

import sys

print "INSERT INTO translation_memories(title, description, user_id, source_language_id, target_language_id, tm_type_id) VALUES ('English-Croatian varia', 'Corpus collected as a student project.', 3, 1, 2, 4);"

sys.stdout.write('INSERT INTO units(translation_memory_id, source_segment, target_segment) VALUES ')

units = []

with open(sys.argv[1], 'r') as f1, open(sys.argv[2], 'r') as f2:
    for line1 in f1:
        line2 = f2.readline()
        units.append("(3, '%s', '%s')" %(line1.strip().replace("'","\\'"), line2.strip().replace("'","\\'")))

print ','.join(units)+';'
