-- CREATE DATABASE checklists;
-- GRANT ALL PRIVILEGES ON DATABASE checklists TO checklists;
CREATE TABLE IF NOT EXISTS lists (
  id serial PRIMARY KEY,
  name VARCHAR(255)
);

CREATE TABLE IF NOT EXISTS list_items (
  id serial PRIMARY KEY,
  list_id int REFERENCES lists(id),
  name VARCHAR(255)
);
