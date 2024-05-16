import queue

q = queue.Queue(maxsize=2)
q.put("Caleb")
q.put("João")
try:
  q.put("Paulo", timeout=2)
except queue.Full:
  print("A fila está cheia")
while not q.empty():
  e = q.get()
  print(e)
