recreate-db: init-db

init-db: recreate-model
	for f in `ls init/*`; do mysql --user=tmuser --password=tmuser tmrepository < $$f; done

recreate-model: tmrepository.sql
	mysql --user=tmuser --password=tmuser tmrepository < $<

