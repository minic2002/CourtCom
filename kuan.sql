SELECT book_coach.bcch_id, 
users.fname, 
users.lname, 
book_coach.Start_Time, 
book_coach.End_Time, 
book_coach.Booking_Date, 
pay_booked_coach.payment_type, 
pay_booked_coach.payment_amount, 
pay_booked_coach.payment_status 
FROM book_coach 
INNER JOIN pay_booked_coach ON pay_booked_coach.bcch_id = book_coach.bcch_id 
INNER JOIN users ON book_coach.user_id = users.user_id 
WHERE book_coach.coach_id = '$coach_id' AND book_coach.Booking_Status = 'Accept'"