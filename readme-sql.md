<!-- Instruction: Please copy and paste the following queries on phpmyadmin. -->

```sql
CREATE TABLE users (username VARCHAR(255) PRIMARY KEY, password VARCHAR(255));
INSERT INTO users VALUES("Amelia-Earhart", "Youaom139&yu7");
INSERT INTO users VALUES("Otto", "StarWars2*");
```

```sql
CREATE TABLE artists (song VARCHAR(255) PRIMARY KEY, artist VARCHAR(255));
INSERT INTO artists VALUES("Freeway", "Aimee Mann");
INSERT INTO artists VALUES("Days of wine and roses", "Bill Evans");
INSERT INTO artists VALUES("These walls", "Kendrick Lamar");
```

```sql
CREATE TABLE ratings (id INTEGER PRIMARY KEY AUTO_INCREMENT, username VARCHAR(255), song VARCHAR(255), rating INT(1), FOREIGN KEY (username) REFERENCES users(username) ON DELETE CASCADE, FOREIGN KEY (song) REFERENCES artists(song) ON DELETE CASCADE);
INSERT INTO ratings (username, song, rating) VALUES("Amelia-Earhart", "Freeway", 3);
INSERT INTO ratings (username, song, rating) VALUES("Amelia-Earhart", "Days of Wine and Roses", 4);
INSERT INTO ratings (username, song, rating) VALUES("Otto", "Days of Wine and Roses", 5);
INSERT INTO ratings (username, song, rating) VALUES("Amelia-Earhart", "These walls", 4);
```
