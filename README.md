# Prosta aplikacja API

**Opis domeny**:\
W szkole podstawowej liczba klas wynosi 6 (A, B, C ...).\
Każda klasa posiada jednego wychowawcę i może być podzielona na 2 grupy językowe. Powinna też liczyć od [1-n] uczniów (imię, nazwisko, płeć).
- klasy oznaczone są symbolami literowymi: A, B, C, D, E, F
- grupy językowe oznaczone są symbolami literowymi: 1, 2

**Endpointy API**:
- /api/pupils/{symbol klasy}
    - zwraca wszystkich uczniów z danej klasy posortowanych po płci
    - metoda GET
- /api/pupils/{symbol klasy}/{symbol grupy językowej}
    - zwraca wszystkich uczniów danej klasy i danej grupy językowej
    - metoda GET
- /api/tutors
    - zwraca wszystkich wychowawców szkoły z informacją, do których klas są przypisani
    - metoda GET

**Przepis uruchomienia projektu**:
- pobrać projekt z GitHub (`git clone`),
- w podkatalogu `docker` wykonać polecenie `docker-compose up`,
- zostaną uruchomione dwa kontenery - dla aplikacji PHP oraz dla systemu bazy danych,
- zostanie utworzona baza danych `szkola` i wypełniona wstępnie danymi (sekwencja wypełniania bazy jest w pliku `src/DataFixtures/AppFixtures.php`),
- zostanie uruchomiony serwer HTTP (wersja dla developera) do obsługi żądań do API,
- uruchomione w ten sposób API jest dostępne pod adresem http://127.0.0.1:8081/api/
- w katalogu `postman` znajduje się kolekcja Postmana z przykładowymi zapytaniami na opisane wyżej endpointy.
