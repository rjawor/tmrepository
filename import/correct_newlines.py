#!/usr/bin/python
# -*- coding: utf-8 -*-

import sys, re

for line in sys.stdin:
    line = line.strip()
    sys.stdout.write(re.sub(r'</tu>','</tu>\n',line))
