def read_votes():
    with open("votos.txt", "r") as votesFile:
        return votesFile.read().splitlines()

def count_votes():
    votes = read_votes()
    candidates = {
        1: "Bart",
        2: "Homer",
        3: "Krusty",
        4: "Mr Burns",
        5: "Ned Flanders"
    }
    votes_count = {}
    for candidate_id in candidates.keys():
        votes_count[candidate_id] = 0
    
    null_votes = 0
    
    for vote in votes:
        vote = int(vote)
        if vote in candidates:
            votes_count[vote] += 1
        else:
            null_votes += 1
    
    max_votes = max(votes_count.values())
    min_votes = min(votes_count.values())
    
    winner_candidate_id = list(votes_count.keys())[list(votes_count.values()).index(max_votes)]
    winner_candidate_name = candidates[winner_candidate_id]
    
    loser_candidate_id = list(votes_count.keys())[list(votes_count.values()).index(min_votes)]
    loser_candidate_name = candidates[loser_candidate_id]
    
    print(f"O candidato mais votado é {winner_candidate_name} com {max_votes} votos")
    print(f"O candidato menos votado é {loser_candidate_name} com {min_votes} votos")
    print(f"Quantidade de votos nulos: {null_votes}")

count_votes()