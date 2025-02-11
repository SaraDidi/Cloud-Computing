
CREATE TABLE students (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    matricul VARCHAR(50) UNIQUE NOT NULL,
    email VARCHAR(100) UNIQUE NULL,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE room (
    id INT AUTO_INCREMENT PRIMARY KEY,
    room_number INT NOT NULL,
    floor_number INT NOT NULL,
    block_number INT NOT NULL,
    availability BOOLEAN NOT NULL DEFAULT TRUE,
    opening_time DATETIME NOT NULL,
    closing_time DATETIME NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE room_occupants (
    id INT AUTO_INCREMENT PRIMARY KEY,
    room_id INT NOT NULL,
    student_id INT NOT NULL,
    FOREIGN KEY (room_id) REFERENCES room(id),
    FOREIGN KEY (student_id) REFERENCES students(id),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE registration_confirmation (
    id INT AUTO_INCREMENT PRIMARY KEY,
    student_id INT NOT NULL,
    room_id INT NOT NULL,
    registration_time DATE NOT NULL,
    expiry_time DATE NOT NULL,
    FOREIGN KEY (student_id) REFERENCES students(id),
    FOREIGN KEY (room_id) REFERENCES room(id),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE complaints (
    id INT AUTO_INCREMENT PRIMARY KEY,
    student_id INT NOT NULL,
    complaint_date DATE NOT NULL,
    status VARCHAR(50) NOT NULL DEFAULT 'Pending',
    title VARCHAR(255) NOT NULL,
    complaint_type VARCHAR(255) NOT NULL,
    body TEXT NOT NULL,
    FOREIGN KEY (student_id) REFERENCES students(id),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);




