from pymongo import MongoClient

client = MongoClient("mongodb://localhost:27017/")
db = client["database"]
collection_name = "position"

if collection_name not in db.list_collection_names():
    db.create_collection(collection_name)
    position_collection_collection = db[collection_name]
    print("Collection '{}' created successfully.".format(collection_name))
else:
    positioon_collection = db[collection_name]

# Define Post model fields


class Position:
    def __init__(self, Leoni_partnumber, Customer_part_number, Type_de_kaba_et_paviol, Num_FIL, name, langeur, LAD, Poste, Position, Couleur, qty_per_loop, min_qty, max_qty):
        self.Leoni_partnumber = Leoni_partnumber
        self.Customer_part_number = Customer_part_number
        self.Type_de_kaba_et_paviol = Type_de_kaba_et_paviol
        self.Num_FIL = Num_FIL
        self.name = name
        self.langeur = langeur
        self.LAD = LAD
        self.Poste = Poste
        self.Position = Position
        self.Couleur = Couleur
        self.qty_per_loop = qty_per_loop
        self.min_qty = min_qty
        self.max_qty = max_qty
