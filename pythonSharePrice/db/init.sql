CREATE DATABASE Stock;
use Stock;

CREATE TABLE stock_price (
  stock VARCHAR(20),
  price VARCHAR(20),
  epox VARCHAR(20)
);

INSERT INTO stock_price
  (stock, price,epox)
VALUES
  ('GOOG', '10000','1'),
  ('MSFT', '1000','2');
