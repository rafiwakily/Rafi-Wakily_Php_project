use rafi;
create view peopleWithCountries as SELECT * FROM 
JOIN countries on ppl.Nationality = countries.COUNTRY_ID