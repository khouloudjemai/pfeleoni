from pymongo import MongoClient

client = MongoClient("mongodb://localhost:27017/")
db = client["database"]
collection_name = "post"

if collection_name not in db.list_collection_names():
    db.create_collection(collection_name)
    lad_collection = db[collection_name]
    print("Collection '{}' created successfully.".format(collection_name))
else:
    lad_collection = db[collection_name]


class Post:
    def __init__(self, poste, LAD, temp_max, temp, hum_max, hum):
        self.poste = poste
        self.LAD = LAD
        self.temp_max = temp_max
        self.temp = temp
        self.hum_max = hum_max
        self.hum = hum
