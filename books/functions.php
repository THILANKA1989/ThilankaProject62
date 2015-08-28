<?php
$bookfromisbn = mysqli_query($connection,"SELECT DISTINCT bk.title As Title, YEAR(bk.date_released) AS Year, bk.price AS Price, cat.name AS Category, pub.name AS Publisher, aut.name AS Author,co.name AS Cover, cp.count AS Copies,bk.isbn AS ISBN,bk.description AS Description
      FROM books bk
              JOIN (SELECT book_id, COUNT(*) as count FROM copies GROUP BY book_id) cp
                ON bk.id = cp.book_id
      JOIN category cat
        ON cat.id = bk.category_id
      JOIN publishers pub
                ON pub.id = bk.publisher_id
      JOIN books_covers bk_co
        ON bk_co.book_id = bk.id
      JOIN covers co
        ON co.id = bk_co.cover_id
      JOIN books_authors bk_aut
        ON bk_aut.book_id = bk.id
      JOIN authors aut
        ON aut.id = bk_aut.author_id
      JOIN books_languages bk_lan
        ON bk_lan.book_id = bk.id
      JOIN languages lan
        ON lan.id = bk_lan.lang_id
      JOIN books_locations bk_loc
        ON bk_loc.book_id = bk.id
      JOIN locations loc
        ON loc.id = bk_loc.location_id
      WHERE ISBN='$isbn' ORDER BY bk.title ASC
        ");

$sqlbookrows = mysqli_fetch_assoc($bookfromisbn);
?>
