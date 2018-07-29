## ABSTRACT
  Library management refers to the issues involved in managing the resources
available in library such as classification of material, book processing and borrowing
materials. Library database system is designed to maintain the library assets in a suitable
way.This report is about a relational database design of a library in which members of the
library can keep track on availability of books, information about membership either they
are student or staff of college, they can join or leave library and some responsibilities of
librarians are added.  
  
 The core goals of this report are to define the entities, attributes and their
relationship to create a database that can be easily manage by admin.  
  
### Following are the facilities:
**Librarian**:​ can check the status of the books issue or submit the [books](#following-are-the-facilities) and manage the
dues of students  
**Member**: ​can check the status of a book ,borrow & return books and can leave and join
library  
  
    

### **OBJECTIVES**:  

The objectives of this report are to provide complete database management for
library which will help to minimize the duplication of data, get rid from paper filling system
and it makes the processing of data very easy without waste of time.

### **LMS work as** :  
  
**1. Browsing/Search books**  

Members can browse the available books according to different features such as
title , categories, authors, publishers. If member wants to borrow a book, he/she needs to
go to library.  
  
**2. Borrow books**  

Librarian is responsible for issuing the books after checking the status of the books
and the queries proposed by the student . One Student can hold a book for maximum of 2
months after that he will be fined.  

**3. Return books**  

When student come to return book , the librarian check in the database for the date
of issue. Librarian updates book status of book issued by member. Librarian updates
availability of the book for other members by updating the entries in the tables of the
database.  

**4. Fine Calculation**  

If the due date of books is passed then librarian collects fine money from member
and update due fine of a member. Fine is considered to be 1rs/day of money after due
date.  
  
**5. Frequency based recommendation**  

LMS will recommend the books which are borrowed by the members having similar
attributes like age, gender,and total issued books etc.  

**6. Graphics User Interface**  

LMS provides friendly graphical user interface for the above mentioned facilities for
members and librarian.  
  
### **DESIGN OF LMS:**  
  
  
**Conceptual Design (E-R Diagram)**  
  
  ![alt_text] ()
  
  
    
**Logical Design (Database schema)**  
 ![alt_text]()
  
  
