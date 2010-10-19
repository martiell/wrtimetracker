# Do NOT use this script. This was an older DB maintenance script, launched under cron, which works incorrectly.
# To maintain DB, use the "Clean up" option in dbinstall.php.
# Later, if a regular cron job is required, we will need to rewrite this script and use proper logic to delete entries.

#! /bin/bash

MYSQL="/usr/local/bin/mysql"

wr_log()
{
  msg=$1
  echo $msg
  logger $msg
}


old=`date -v-3m +%Y-%m-%d`
sql="use wrtts
delete from activity_log where al_date < '${old}';"

wr_log "Deleting timetracker records before ${old} from ACTIVITY_LOG"
echo "${sql}"|${MYSQL}
if [ $? -ne 0 ] ; then
  wr_log "Error while deleting records before ${old} from ACTIVITY_LOG"
fi


old=`date -v-11m +%Y-%m-%d`
sql="use wrtts
delete from activities where a_timestamp < '${old}';"

wr_log "Deleting timetracker records before ${old} from ACTIVITIES"
echo "${sql}"|${MYSQL}
if [ $? -ne 0 ] ; then
  wr_log "Error while deleting records before ${old} from ACTIVITIES"
fi


old=`date -v-11m +%Y-%m-%d`
sql="use wrtts
delete from from projects where p_timestamp < '${old}';"

wr_log "Deleting timetracker records before ${old} from PROJECTS"
echo "${sql}"|${MYSQL}
if [ $? -ne 0 ] ; then
  wr_log "Error while deleting records before ${old} from PROJECTS"
fi


old=`date -v-11m +%Y-%m-%d`
sql="use wrtts
delete from users where u_timestamp < '${old}';"

wr_log "Deleting timetracker records before ${old} from USERS"
echo "${sql}"|${MYSQL}
if [ $? -ne 0 ] ; then
  wr_log "Error while deleting records before ${old} from USERS"
fi