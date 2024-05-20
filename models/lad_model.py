from pymongo import MongoClient

client = MongoClient("mongodb://localhost:27017/")
db = client["database"]

collection_name = "lad"

if collection_name not in db.list_collection_names():
    db.create_collection(collection_name)
    lad_collection = db[collection_name]
    print("Collection '{}' created successfully.".format(collection_name))
else:
    lad_collection = db[collection_name]


class Lad:
    def __init__(self, lad, poste, position, Type_de_kaba_et_paviol, name, qty_per_loop, temp, hum, min_qty, max_qty):
        self.lad = lad
        self.poste = poste
        self.position = position
        self.Type_de_kaba_et_paviol = Type_de_kaba_et_paviol
        self.name = name
        self.qty_per_loop = qty_per_loop
        self.min_qty = min_qty
        self.max_qty = max_qty
        self.temp = temp
        self.hum = hum
