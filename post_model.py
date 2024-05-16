from pymongo import MongoClient

client = MongoClient("mongodb://localhost:27017/")
db = client["database"]
post_collection = db["post"]

# Define Post model fields
class Post:
    def __init__(self, poste, LAD , temp_max , temp , hum_max ,hum  ):
        self.poste = poste
        self.LAD = LAD
        self.temp_max =temp_max
        self.temp =temp
        self.hum_max = hum_max
        self.hum = hum
        
