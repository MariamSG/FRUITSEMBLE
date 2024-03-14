import mysql.connector
import json

# MySQL database configuration
db_config = {
    'host': 'localhost',
    'user': 'root',
    'password': '',
    'database': 'fruits',
    'port': 3306
}

# Path to your JSON file
json_file_path = 'C:/msg/GADS/xampp/htdocs/Fruitsemble/all.json'

# Connect to MySQL
try:
    connection = mysql.connector.connect(**db_config)
    cursor = connection.cursor()

    # Read JSON file
    with open(json_file_path, 'r') as json_file:
        data = json.load(json_file)

        # Assuming your JSON file has a list of dictionaries
        for item in data:
            # Extract nutritions dictionary from the item
            nutritions = item.get('nutritions', {})

            # Construct the SQL query
            sql_query = """
                INSERT INTO data 
                (name, id, family, `order`, genus, calories, fat, sugar, carbohydrates, protein)
                VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s)
            """

            # Replace 'your_table_name' with your actual table name
            values = (
                item.get('name', None), item.get('id', None), item.get('family', None),
                item.get('order', None), item.get('genus', None),
                nutritions.get('calories', None), nutritions.get('fat', None),
                nutritions.get('sugar', None), nutritions.get('carbohydrates', None),
                nutritions.get('protein', None)
            )

            # Execute the query
            cursor.execute(sql_query, values)

    # Commit changes to the database
    connection.commit()

except mysql.connector.Error as err:
    print(f"Error: {err}")

finally:
    # Close the database connection
    if connection.is_connected():
        cursor.close()
        connection.close()
        print("MySQL connection is closed.")
