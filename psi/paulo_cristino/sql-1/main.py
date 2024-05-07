
import sqlite3

con=sqlite3.connect("base_dados.db")

cur=con.cursor()

cur.execute('''CREATE TABLE IF NOT EXISTS users(id INTEGER PRIMARY KEY, nome TEXT, idade INTEGER)''')

userId = int(input("Digite o id: "))
name = input("Digite o nome: ")
age = int(input("Digite a idade: "))

cur.execute("INSERT INTO users VALUES (?,?,?)", (userId, name, age))

con.commit()

cur.execute("SELECT * FROM users")
for linha in cur.fetchall():
    print(linha)