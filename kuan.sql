SELECT book_coach.bcch_id, 
users.fname,
users.lname, 
book_coach.Start_Time, 
book_coach.End_Time, 
book_coach.Booking_Date, 
book_coach.Booking_Status, 
pay_booked_coach.payment_status 
FROM book_coach 
INNER JOIN coach ON book_coach.coach_id = coach.coach_ID 
INNER JOIN pay_booked_coach ON pay_booked_coach.bcch_id = book_coach.bcch_id 
INNER JOIN users ON users.user_id = coach.user_id
WHERE book_coach.user_id = 77