import sqlite3

conn = sqlite3.connect('./bd/muraldevagas.db')
cursor = conn.cursor()

# Criar a tabela "users" se não existir
cursor.execute ('''
CREATE TABLE IF NOT EXISTS users (
id INTEGER PRIMARY KEY AUTOINCREMENT,
nome TEXT NOT NULL,
senha VARCHAR (256)
)
''')

# Criar a tabela "ads" se não existir
cursor.execute ('''
CREATE TABLE IF NOT EXISTS ads (
id INTEGER PRIMARY KEY AUTOINCREMENT,
titulo TEXT (40),
descricao TEXT (3000),
imagem VARCHAR
)
''')

conn.commit()
conn.close()