all: mirrormind

mirrormind: main.o interface.o reflection.o
	gcc -o mirrormind main.o interface.o reflection.o

main.o: main.c interface.h reflection.h
	gcc -c main.c

interface.o: interface.c interface.h
	gcc -c interface.c

reflection.o: reflection.c reflection.h
	gcc -c reflection.c

clean:
	rm -f *.o mirrormind reflections.txt reflections.json