from pymongo import MongoClient

client = MongoClient("mongodb://localhost:27017/")
db = client["database"]

collection_name = "user"

if collection_name not in db.list_collection_names():
    db.create_collection(collection_name)
    lad_collection = db[collection_name]
    print("Collection '{}' created successfully.".format(collection_name))
else:
    lad_collection = db[collection_name]


class User:
    def __init__(self, username, email, session):
        self.username = username
        self.email = email
        self.session = session
