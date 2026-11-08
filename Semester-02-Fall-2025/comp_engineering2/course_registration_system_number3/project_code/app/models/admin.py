# app/models/admin.py
from typing import Dict

class Admin:
    def __init__(self, username: str, full_name: str, password_hash: str):
        self.username = username
        self.full_name = full_name
        self.password_hash = password_hash

    def to_dict(self) -> Dict:
        return {
            "username": self.username,
            "full_name": self.full_name,
            "password_hash": self.password_hash
        }

    @staticmethod
    def from_dict(d: Dict) -> "Admin":
        return Admin(d["username"], d["full_name"], d["password_hash"])
