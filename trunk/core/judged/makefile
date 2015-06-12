all: judged.cc
	g++ -Wall -c -I/usr/local/mysql/include/mysql -I/usr/include/mysql  judged.cc
	g++ -Wall -o judged judged.o -L/usr/lib64/mysql -L/usr/local/mysql/lib/mysql -L/usr/lib/mysql  -lmysqlclient
