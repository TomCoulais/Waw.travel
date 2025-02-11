INSERT INTO "vehicle" (type) VALUES
('Car'),
('Motorcycle'),
('Van');

INSERT INTO "road_trip" (title, cover_image, vehicle_id, user_id, start_date, end_date, is_community) VALUES
('Trip to the mountains', 'cover1.jpg', 1, 1, '2025-06-01', '2025-06-10', false),
('Desert adventure', 'cover2.jpg', 2, 2, '2025-07-15', '2025-07-25', true);

INSERT INTO "checkpoint" (spot_name, longitude, latitude, road_trip_id) VALUES
('Mountain View', 45.6789, -73.4567, 1),
('Lake Stop', 45.6790, -73.4570, 1),
('Desert Entrance', 32.7767, -117.1833, 2),
('Final Camp', 33.0011, -117.2000, 2);

SELECT * FROM "user";
SELECT * FROM "vehicle";
SELECT * FROM "road_trip";
SELECT * FROM "checkpoint";
