import shutil

shutil.copy(src='arquivo.txt', dst='arquivo_copia.txt')
shutil.move(src='arquivo.txt', dst='novo_diretorio/arquivo.txt')
shutil.rmtree(path='novo_diretorio')
