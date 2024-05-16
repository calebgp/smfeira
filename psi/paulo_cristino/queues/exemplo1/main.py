import queue

q = queue.Queue()
q.put("Caleb")
q.put("João")
q.put("Paulo")
while not q.empty():
  e = q.get()
  print(e)
