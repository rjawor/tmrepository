INSERT INTO users(username, password, role_id, firstname, lastname, email) VALUES ('test', '$2y$10$aR3htCVLkY7mC22GcBfLF.6FPKwaFdJKb4KF.dhEjA9fuguWMb9mm', 2, 'test first name','test last name', 'test@example.com');

INSERT INTO translation_memories(title, description, user_id, source_language_id, target_language_id, tm_type_id) VALUES ('phone manual', 'translated manual of a smartphone', 1, 1, 2, 1);

INSERT INTO translation_memories(title, description, user_id, source_language_id, target_language_id, tm_type_id) VALUES ('The Martian - subtitles', 'subtitles of The Martian', 1, 1, 2, 3);

INSERT INTO units(translation_memory_id, source_segment, target_segment) VALUES (1, 'Place your device in a safe area to prevent it from unauthorized use', 'Postavite uređaj na sigurno područje kako bi se spriječilo neovlašteno korištenje'),  (1,'
Postavite zaslon uređaja za zaključavanje i stvoriti lozinku ili uzorak za otključavanje da biste ga otvorili.',''), (1, 'Periodically back up personal information kept on your memory card, or stored in your device memory.', '
Povremeno kopiju osobne podatke čuvaju na memorijskoj kartici, ili pohranjene u memoriji uređaja.'), (2, 'Well, I like you know that
visual inspection of the equipment is imperative to mission success.', 'Pa, sviđa li znali da
vizualni pregled opreme je imperativ za uspjeh misije.'), (2,'I also like to report that the MAV is still upright.','Također sam kao da izvješće koje je MAV i dalje uspravno.'), (2,'Watney, you keep leaving your channel open','Watney, te držati ostavljajući otvoreni kanal
');
