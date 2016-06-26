-- Creation of blog admin with all privileges, only for db modification
CREATE USER theblog_admin@localhost identified by 'zaq1@WSX';

GRANT ALL PRIVILEGES on theblog.* to theblog_admin@localhost WITH GRANT OPTION;

-- Creation of user for usual blog activities, with no privileges for db structure alteration
CREATE USER theblog@localhost identified by 'strongpassword';

GRANT SELECT, INSERT, UPDATE, DELETE on theblog.* to theblog@localhost;