import sqlite3

con = sqlite3.connect('management.db')

cur = con.cursor()

cur.execute('''CREATE TABLE IF NOT EXISTS products(code INTEGER PRIMARY KEY, name TEXT, stock INTEGER, price REAL)''')

code = int(input("Digite o código do produto: "))
name = input("Digite o nome do produto: ")
stock = int(input("Digite a quantidade em estoque: "))
price = float(input("Digite o preço do produto:"))

cur.execute("INSERT INTO products VALUES (?,?,?,?)", (code, name, stock, price))

con.commit()

cur.execute("SELECT * FROM products")
for linha in cur.fetchall():
    print(linha)