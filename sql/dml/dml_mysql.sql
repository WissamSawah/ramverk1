

DELETE FROM Questions;
INSERT INTO Questions (title, userID, tags, question)
   VALUES
   ('Is it worth to watch John Wick 3?', '1', 'JohnWick3', 'I see this movie, referenced on Ask4Movie, more than any other. However, I passed it up like I do with many Keanu Reeves’ movies that come out.');


DELETE FROM Tags;
INSERT INTO Tags (tag, counter)
  VALUES
  ('JohnWick3', 1);

DELETE FROM User;
INSERT INTO User (email, acronym, password, firstname, lastname)
 VALUES
 ('wesam.sawah@me.com', 'aisa18', '$2y$10$LIcFyosOoNyBnqvpnK2tt.rhIySx6B/JwBhkl4WkjRJjjr4ic8l1a', 'Wissam', 'Sawah');
