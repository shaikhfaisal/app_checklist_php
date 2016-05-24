CREATE DATABASE checklists;
GRANT ALL PRIVILEGES ON DATABASE checklists TO checklists;
CREATE TABLE lists (
  id serial PRIMARY KEY,
  name VARCHAR(255)
);

CREATE TABLE list_items (
  id serial PRIMARY KEY,
  list_id int REFERENCES lists(id),
  name VARCHAR(255)
);