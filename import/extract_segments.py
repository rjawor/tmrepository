#!/usr/bin/python
# -*- coding: utf-8 -*-

import sys, re

srcLang = sys.argv[2]
trgLang = sys.argv[4]

with open(sys.argv[1], 'w') as src, open(sys.argv[3], 'w') as trg:
	for line in sys.stdin:
		src_segment = None
		trg_segment = None
		segments = re.findall(r'<tuv\s+xml:lang="([A-Za-z\-]+)">\s*<seg>\s*(<S.*?>)?(.*?)(</S>)?\s*</seg>\s*</tuv>', line)
		for segment in segments:
			if segment[0].lower().startswith(srcLang.lower()):
				src_segment = segment[2]
			elif segment[0].lower().startswith(trgLang.lower()):
				trg_segment = segment[2]
		if (not src_segment is None) and (not trg_segment is None):
			src.write(src_segment+'\n')
			trg.write(trg_segment+'\n')
