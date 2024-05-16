from pymongo import MongoClient

client = MongoClient("mongodb://localhost:27017/")
db = client["database"]
user_collection = db["user"]

# Define User model fields
class User:
    def __init__(self, username, email):
        self.username = username
        self.email = email
