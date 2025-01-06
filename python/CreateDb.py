import sqlite3
import os


# Adiciona o caminho relativo do script
base_dir = os.path.dirname(__file__) # Armazena o diretório do script atual
db_path = os.path.join(base_dir, './db/database.db') # Caminho relativo do banco de dados

conn = sqlite3.connect(db_path)
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