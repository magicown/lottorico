/bin/bash

DB_BACKUP="/home/lotto/dbbackup/"

DB_USER="lotto"

DB_PASSWD="jun1126k!"

db="lotto"

# table=""



# Remove backups older than 3 days

find $DB_BACKUP -ctime +7 -exec rm -f {} \;







# 데이터베이스를 모두 백업할경우 

# mysqldump --user=$DB_USER --password=$DB_PASSWD -A | gzip > "$DB_BACKUP/mysqldump-$db-$(date +%Y-%m-%d).gz";





# 데이터베이스를 백업할경우 

mysqldump --user=$DB_USER --password=$DB_PASSWD $db | gzip > "$DB_BACKUP/mysqldump-$db-$(date +%Y-%m-%d-%H%I).gz";




# 데이터베이스의 특정 테이블을 백업할경우 

# mysqldump --user=$DB_USER --password=$DB_PASSWD $db $table | gzip > "$DB_BACKUP/mysqldump-$db-$table-$(date +%Y-%m-%d).gz";

