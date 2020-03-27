package webapp;
import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.ResultSet;
import java.sql.Statement;
import java.util.ArrayList;
import java.util.Scanner;

public class DatabaseConnector {

		static int id, idcheck = 0, BookIdCheck;
		static String fName = null, lName = null, BookName, Bookname, id2;
		static boolean idTry = true;
		static int MemberChose, MorE, EmemberChose;
		static String Bookid;
		static boolean Eid = true;
		static Scanner input = new Scanner(System.in);
		
	public static void main(String[] args) {
	try{  
		
		//Class.forName("com.mysql.jdbc.Driver");  
		Class.forName("com.mysql.jdbc.Driver");  
		Connection con=DriverManager.getConnection("jdbc:mysql://localhost:3306/library","root","1qaz2wsx!QAZ@WSX"); 
		Statement stmt=con.createStatement(); 
		System.out.println("Connection Sucessful");
		//this is to find the MemeberId as a result set
		System.out.println("Are you a Member or Employee?");
		System.out.println("(1) member");
		System.out.println("(2) Employee");
		MorE = input.nextInt();
		//this is to see who is a member or not
		if(MorE == 1) {
		System.out.println("Library Id:");
		id = input.nextInt();
		ResultSet MId = stmt.executeQuery("SELECT Member_Id FROM LibMember WHERE Member_ID = '"+ id+"'");
		while(MId.next()) {
			idcheck = Integer.valueOf(MId.getInt(1));
		}
		if(id == idcheck) {
		ResultSet Name = stmt.executeQuery("select Member_Fname, Member_Lname from LibMember where Member_ID = '"+ id+"'");
		while(Name.next()) {
		fName = Name.getString("Member_Fname");
		lName = Name.getString("Member_Lname");
		}
			System.out.println("Welcome "+fName+" "+lName);
		}else {System.out.println("Wrong ID");
		System.exit(0);}
		Menu();
		while(MemberChose != 4) {
		if(MemberChose == 1) {
		System.out.println("what the name of the book: ");
		//this will find the book by the name and find the dewDecimalnum of the book
		BookName = input.nextLine();
		ResultSet Book = stmt.executeQuery("select DewDecimalNum, NumberAvailable from Book where BookName like '"+ BookName+"'");
		while(Book.next()) {
			BookIdCheck = Integer.valueOf(Book.getString(1));
			System.out.println("Book Available:"+Book.getString(2));
		}
		//this will insert into the membertoBook
		ResultSet insert = stmt.executeQuery("insert into MemberToBook(MemberId, BookId) values("+ id+", "+BookIdCheck +")");
		System.out.println("Book Added to "+fName+" "+lName);
		Menu();
		}//this one for returning a book by deleting it from the membertobook
		else if(MemberChose == 2) {
			int countbook = 0;
			ResultSet findbookid = stmt.executeQuery("select BookId from MemberToBook where MemberId == "+id);
			while(findbookid.next()) {
						System.out.println(findbookid.getString(countbook));
						countbook++;
			}
			System.out.println("What is the bookId?");
			Bookid = input.nextLine();
				ResultSet deleteId = stmt.executeQuery("select BookId from MemberToBook where BookId == "+Bookid);
			if(Bookid.equalsIgnoreCase(deleteId.getString(1))) {
				ResultSet delete = stmt.executeQuery("Delete FROM MemberToBook WHERE BookId == "+Bookid);
			}else {
				System.out.println("no book found");
			}
			Menu();
		}
		else if(MemberChose == 3) {
			ResultSet MemName = stmt.executeQuery("select Member_Fname, Member_Lname, Address, MState, MCity from LibMember where Member_ID == "+ id);
			while(MemName.next()) {
				System.out.println("Name: "+MemName.getString(1)+" "+MemName.getString(2)+"\n");
				System.out.println("ID: "+ id);
				System.out.println("Address: " + MemName.getString(3)+", "+MemName.getString(4)+", "+MemName.getString(5)+"\n");
			}
			Menu();
		}
		}
		//this is the member secition
		}else if(MorE == 2) {
			System.out.println("EmployeeLibrary Id:");
			id = input.nextInt();
			ResultSet EId = stmt.executeQuery("select e.Employee_SSN from Employee e where e.Employee_SSN =="+id);
			if(EId.getString(1).equalsIgnoreCase(id2)) {
				System.out.println("welcome Employee");
			}else {
				System.out.println("wrong ssn byee"); 
				Eid = false;
				System.exit(0);
			}
		}
		while(EmemberChose !=3) {
			if(EmemberChose == 1) {
				System.out.println("what is the book Name to order?");
				Bookname = input.nextLine();
				ResultSet Order = stmt.executeQuery("insert into OrderList(BookName) values("+BookName+");");
				Menu2();
			}else if(EmemberChose==2) {
				ResultSet name = stmt.executeQuery("select Employee_Fname, Employee_Lname, Job, LibraryId from Employee where Employee_SSN == "+id);
				ResultSet location = stmt.executeQuery("select LibraryName, City, State from LibraryLocation where LibraryIdLocation == "+name.getString(4));
				while(name.next()) {
					System.out.println("Name: "+name.getString(1)+" "+ name.getString(2)+"\n");
					System.out.println("Job: "+ name.getString(3)+"\n");
					System.out.println("location: "+ location.getString(1)+" ,"+location.getString(2)+ ", " + location.getString(3));
				}
				Menu2();
			}
		}
	}//this will catch the error if it doesnt connect
	catch(Exception e){
		System.out.println("Aint working chief");
		System.out.println(e);
		} 
	
}
	public static void Menu() {
		System.out.println("1 Book Search");
		System.out.println("2 Return Book");
		System.out.println("3 Member Information");
		System.out.println("4 exit");
		MemberChose = input.nextInt();
	}
	public static void Menu2() {
		System.out.println("1 Orderlist");
		System.out.println("2 Employee information");
		System.out.println("3 exit");
		EmemberChose = input.nextInt();
	}
	
	// Member methods
	public static boolean validateMember(int password){
		boolean check = false;
		int ID = password;
		try {
			Class.forName("com.mysql.jdbc.Driver");  
			Connection con=DriverManager.getConnection("jdbc:mysql://localhost:3306/library","root","1qaz2wsx!QAZ@WSX"); 
			Statement stmt=con.createStatement(); 
			System.out.println("Connection Sucessful checking member id");
			//Search database for match
			ResultSet MId = stmt.executeQuery("select Member_ID from LibMember  where Member_ID = '"+ID+"';");
			while(MId.next()) {
				idcheck = Integer.valueOf(MId.getInt(1));
			}
			if(password == idcheck) {
				ResultSet Name = stmt.executeQuery("select Member_Fname, Member_Lname from LibMember where Member_ID = '"+password+"';");
				while(Name.next()) {
					fName = Name.getString("Member_Fname");
					lName = Name.getString("Member_Lname");
					check = true;
				}
				System.out.println("Welcome "+fName+" "+lName);
			}else{
				System.out.println("Wrong ID");
				check = false;
			}
			//Return true if match
			con.close();
		}//this will catch the error if it doesnt connect
		catch(Exception e){System.out.println(e);} 
		
		return check;
	}
	//Displays the Specifically searched books
	public static String[] getSpecificBooks(String bName) {
		ArrayList<String> a1 = new ArrayList<String>(); 
		String result[] =  new String[500];
		a1.add("BookName");
		a1.add("NumOfBookOrdered");
		a1.add("AuthorFirstName");
		a1.add("AuthorLastName");
		a1.add("DateOfPublication");
		a1.add("DewDecimalNum");
		a1.add("NumberAvailable");
		a1.add("Number_in_Total");
		a1.add("LibraryId");

		try {
			Class.forName("com.mysql.cj.jdbc.Driver");  
			Connection con=DriverManager.getConnection("jdbc:mysql://localhost:3306/library","root","1qaz2wsx!QAZ@WSX"); 
			Statement avail = con.createStatement();
			ResultSet res = avail.executeQuery("SELECT BookName, "
					+ "NumOfBookOrdered, AuthorFirstName, AuthorLastName,"
					+ "DateOfPublication, DewDecimalNum, NumberAvailable, "
					+ "NumberAvailable, Number_in_Total, LibraryId FROM Book WHERE BookName LIKE '%"+bName+"%';");
			int a = 9;
			while (res.next()) {

				a1.add(res.getString("BookName"));
				a++;
				int v = res.getInt("NumOfBookOrdered");
				a1.add(Integer.toString(v));
				a++;
				a1.add(res.getString("AuthorFirstName"));
				a++;
				a1.add(res.getString("AuthorLastName"));
				a++;
				a1.add( res.getString("DateOfPublication"));
				a++;
				v = res.getInt("DewDecimalNum");
				a1.add(Integer.toString(v));
				a++;
				v = res.getInt("NumberAvailable");
				a1.add(Integer.toString(v));
				a++;
				v = res.getInt("Number_in_Total");
				a1.add(Integer.toString(v));
				a++;
				v = res.getInt("LibraryId");
				a1.add(Integer.toString(v));
				a++;


			}
			con.close();
			}catch(Exception e){System.out.println(e);}
        String str[] = new String[a1.size()]; 
        
        // ArrayList to Array Conversion 
        for (int j = 0; j < a1.size(); j++) { 
  
            // Assign each value to String array 
            str[j] = a1.get(j); 
        }
		return str;
	}
	public static void setOwnedBooks(int id, int bid) {
		String result = "";
		try {
			Class.forName("com.mysql.cj.jdbc.Driver");  
			Connection con=DriverManager.getConnection("jdbc:mysql://localhost:3306/library","root","1qaz2wsx!QAZ@WSX"); 
	   		String query = "INSERT INTO MemberToBook VALUES ('"+id+"','"+bid+"','12/6/2019','1');";
	   		Statement stmt=con.createStatement(); 
	   		stmt.executeUpdate(query); 
		}catch(Exception e){System.out.println(e);} 
	}
	public static String getOwnedBooks(int i) {
		String result = "";
		try {
			Class.forName("com.mysql.cj.jdbc.Driver");  
			Connection con=DriverManager.getConnection("jdbc:mysql://localhost:3306/library","root","1qaz2wsx!QAZ@WSX"); 
			Statement stmt=con.createStatement();
			ResultSet res = stmt.executeQuery("SELECT BookId FROM MemberToBook WHERE MemberId ='"+i+"';");
			while(res.next()) {
				result+= "\r\n";
				result+=res.getInt("BookId");
			}
		}catch(Exception e){System.out.println(e);} 
		return result;
	}
	public static void returnBook(int bookId, int memId) {
		try {
			Class.forName("com.mysql.cj.jdbc.Driver");  
			Connection con=DriverManager.getConnection("jdbc:mysql://localhost:3306/library","root","1qaz2wsx!QAZ@WSX"); 
			Statement stmt=con.createStatement();
			ResultSet delete = stmt.executeQuery("Delete FROM MemberToBook WHERE BookId = '"+bookId+"' AND MemberId ='"+memId+"';");

		}catch(Exception e){System.out.println(e);} 

	}
	public static String[] getMemberInfo(int id) {
		String result[] = new String[3];
		try {
			Class.forName("com.mysql.cj.jdbc.Driver");  
			Connection con=DriverManager.getConnection("jdbc:mysql://localhost:3306/library","root","1qaz2wsx!QAZ@WSX"); 
			Statement stmt=con.createStatement(); 
			ResultSet MemName = stmt.executeQuery("select Member_Fname, Member_Lname, Address, MState, MCity from LibMember where Member_ID = '"+ id+"';");
			while(MemName.next()) {
				result[0] = ("Name: "+MemName.getString(1)+" "+MemName.getString(2));
				result[1] =("ID: "+ id);
				result[2] =("Address: " + MemName.getString(3)+", "+MemName.getString(4)+", "+MemName.getString(5));
			}
			con.close();
		}//this will catch the error if it doesnt connect
		catch(Exception e){System.out.println(e);} 
		return result;
	}
	
	// Employee methods------------------------------------------------------------------------------
	public static boolean validateEmployee(String ssn){
		boolean check = false;
		String SSN = ssn;
		try {
			Class.forName("com.mysql.cj.jdbc.Driver");  
			Connection con=DriverManager.getConnection("jdbc:mysql://localhost:3306/library","root","1qaz2wsx!QAZ@WSX"); 
			Statement stmt=con.createStatement(); 
			System.out.println("Connection Sucessful");
		//Search database for match

			ResultSet EId = stmt.executeQuery("select Employee_SSN from Employee where Employee_SSN LIKE'"+SSN+"';");
			String res = "";
			if(EId.next()) {
			res = EId.getString("Employee_SSN");
			System.out.println("SSN Found:"+res);
			}
			if(SSN.equals(res)) {
				System.out.println("welcome Employee");
				check = true;
			}else {
				System.out.println("wrong ssn byee"); 
				check = false;
			}
			//Return true if match
			con.close();
		}catch(Exception e){System.out.println(e);} 
		return check;
	}
	//=============================================================================================
	public static String getOrderList() {
		String result = null;
		try {
			Class.forName("com.mysql.cj.jdbc.Driver");  
			Connection con=DriverManager.getConnection("jdbc:mysql://localhost:3306/library","root","1qaz2wsx!QAZ@WSX");  
			Statement stmt=con.createStatement(); 
			
			System.out.println("Connection Sucessful, Getting orders");
			ResultSet Order = stmt.executeQuery("SELECT BookName FROM OrderList;");
			while(Order.next()) {
				result+=(Order.getString("BookName"));
				result+=",";
			}
			System.out.println("Orders:"+result);
			con.close();
		}catch(Exception e){System.out.println(e);} 
		return result;
	}
	public static void setOrder(String name, String id) {
		int z =Integer.parseInt(id);
		try {
			Class.forName("com.mysql.cj.jdbc.Driver");  
			Connection con=DriverManager.getConnection("jdbc:mysql://localhost:3306/library","root","1qaz2wsx!QAZ@WSX"); 
			Statement stmt=con.createStatement(); 
			
			System.out.println("Connection Sucessful, setting orders");
			String query = ("insert into OrderList (BookName, LibraryIdO, EmployeeOrder) values('"+name+"','"+z+"','107-84-2427');");
			stmt.executeUpdate(query);
			con.close();
		}catch(Exception e){System.out.println(e);} 

	}
	public static String[] getEmployeeInfo(String ssn) {

		String result[] = new String[3];
		try {
			Class.forName("com.mysql.cj.jdbc.Driver");  
			Connection con=DriverManager.getConnection("jdbc:mysql://localhost:3306/library","root","1qaz2wsx!QAZ@WSX"); 
			Statement stmt=con.createStatement(); 
			System.out.println("Connection Sucessful");
			ResultSet name = stmt.executeQuery("select Employee_Fname, Employee_Lname, Job, LibraryId from Employee where Employee_SSN = '"+ssn+"';");
		
			while(name.next()) {
				result[0] = ("Name: "+name.getString(1)+" "+ name.getString(2));
				result[1] = ("Job: "+ name.getString(3));
				result[2] = ("Location: "+ name.getString(4));
			}
			con.close();
		}catch(Exception e){System.out.println(e);} 
		return result;
	}
	public static String[] getAllBooksInfo() {
		ArrayList<String> a1 = new ArrayList<String>(); 
		String result[] =  new String[500];
		a1.add("BookName");
		a1.add("NumOfBookOrdered");
		a1.add("AuthorFirstName");
		a1.add("AuthorLastName");
		a1.add("DateOfPublication");
		a1.add("DewDecimalNum");
		a1.add("NumberAvailable");
		a1.add("Number_in_Total");
		a1.add("LibraryId");

		try {
			Class.forName("com.mysql.cj.jdbc.Driver");  
			Connection con=DriverManager.getConnection("jdbc:mysql://localhost:3306/library","root","1qaz2wsx!QAZ@WSX"); 
			Statement avail = con.createStatement();
			ResultSet res = avail.executeQuery("SELECT BookName, "
					+ "NumOfBookOrdered, AuthorFirstName, AuthorLastName,"
					+ "DateOfPublication, DewDecimalNum, NumberAvailable, "
					+ "NumberAvailable, Number_in_Total, LibraryId FROM Book;");
			int a = 9;
			while (res.next()) {

				a1.add(res.getString("BookName"));
				a++;
				int v = res.getInt("NumOfBookOrdered");
				a1.add(Integer.toString(v));
				a++;
				a1.add(res.getString("AuthorFirstName"));
				a++;
				a1.add(res.getString("AuthorLastName"));
				a++;
				a1.add( res.getString("DateOfPublication"));
				a++;
				v = res.getInt("DewDecimalNum");
				a1.add(Integer.toString(v));
				a++;
				v = res.getInt("NumberAvailable");
				a1.add(Integer.toString(v));
				a++;
				v = res.getInt("Number_in_Total");
				a1.add(Integer.toString(v));
				a++;
				v = res.getInt("LibraryId");
				a1.add(Integer.toString(v));
				a++;


			}
			con.close();
			}catch(Exception e){System.out.println(e);} 
        String str[] = new String[a1.size()]; 
        
        // ArrayList to Array Conversion 
        for (int j = 0; j < a1.size(); j++) { 
  
            // Assign each value to String array 
            str[j] = a1.get(j); 
        }
		return str;

	}
	public static String[] getAllEmployeesInfo() {
		ArrayList<String> a1 = new ArrayList<String>(); 
		String result[] =  new String[500];
		a1.add("Employee_Fname");
		a1.add("Employee_Lname");
		a1.add("Employee_SSN");
		a1.add("Job");
		a1.add("Hours_per_week");
		a1.add("LibraryId");
		try {
			Class.forName("com.mysql.cj.jdbc.Driver");  
			Connection con=DriverManager.getConnection("jdbc:mysql://localhost:3306/library","root","1qaz2wsx!QAZ@WSX"); 
			Statement avail = con.createStatement();
			ResultSet res = avail.executeQuery("SELECT Employee_Fname, "
					+ "Employee_Lname, Employee_SSN, Job,"
					+ "Hours_per_week, LibraryId FROM Employee;");
			int a = 9;
			while (res.next()) {
				int v;
				a1.add(res.getString("Employee_Fname"));
				a++;
				a1.add(res.getString("Employee_Lname"));
				a++;
				a1.add(res.getString("Employee_SSN"));
				a++;
				a1.add(res.getString("Job"));
				a++;
				v = res.getInt("Hours_per_week");
				a1.add(Integer.toString(v));
				a++;
				v = res.getInt("LibraryId");
				a1.add(Integer.toString(v));
				a++;


			}
			con.close();
			}catch(Exception e){System.out.println(e);} 
        String str[] = new String[a1.size()]; 
        
        // ArrayList to Array Conversion 
        for (int j = 0; j < a1.size(); j++) { 
  
            // Assign each value to String array 
            str[j] = a1.get(j); 
        }
		return str;

	}
	public static String[] getAllMembersInfo() {
		ArrayList<String> a1 = new ArrayList<String>(); 
		String result[] =  new String[500];
		a1.add("Member_Fname");
		a1.add("Member_Lname");
		a1.add("Member_ID");
		a1.add("Address");
		a1.add("MState");
		a1.add("MLibary");

		try {
			Class.forName("com.mysql.cj.jdbc.Driver");  
			Connection con=DriverManager.getConnection("jdbc:mysql://localhost:3306/library","root","1qaz2wsx!QAZ@WSX"); 
			Statement avail = con.createStatement();
			ResultSet res = avail.executeQuery("SELECT Member_Fname, Member_Lname, "
					+ "Member_ID, Address, MState,"
					+ "MLibary FROM LibMember;");
			int a = 9;
			while (res.next()) {
				int v;
				a1.add(res.getString("Member_Fname"));
				a++;
				a1.add(res.getString("Member_Lname"));
				a++;
				v = res.getInt("Member_ID");
				a1.add(Integer.toString(v));
				a++;
				a1.add(res.getString("Address"));
				a++;
				a1.add( res.getString("MState"));
				a++;
				v = res.getInt("MLibary");
				a1.add(Integer.toString(v));

			}
			con.close();
			}catch(Exception e){System.out.println(e);} 
        String str[] = new String[a1.size()]; 
        
        // ArrayList to Array Conversion 
        for (int j = 0; j < a1.size(); j++) { 
  
            // Assign each value to String array 
            str[j] = a1.get(j); 
        }
		return str;

	}
	public static void CreateEmployee(String fname2, String lname2, String ssn, String job, String hours, String libID) {
		
		int y =Integer.parseInt(hours);
		int z =Integer.parseInt(libID);
		
		try {
			Class.forName("com.mysql.cj.jdbc.Driver");  
			Connection con=DriverManager.getConnection("jdbc:mysql://localhost:3306/library","root","1qaz2wsx!QAZ@WSX"); 
	   		String query = "insert into Employee VALUES ('"+fname2+"','"+lname2+"','"+ssn+"','"+job+"','"+y+"','"+z+"');";
	   		Statement stmt=con.createStatement(); 
	   		stmt.executeUpdate(query); 
	   		con.close();
		}catch(Exception e){System.out.println(e);} 
	}
	public static void CreateMember(String fname, String lname, String add, String state, String city, String country, String libID) {
		
		int z =Integer.parseInt(libID);
		int newID = 0;
		
		try {
			Class.forName("com.mysql.cj.jdbc.Driver");  
			Connection con=DriverManager.getConnection("jdbc:mysql://localhost:3306/library","root","1qaz2wsx!QAZ@WSX"); 
			Statement avail = con.createStatement();
			ResultSet res = avail.executeQuery("SELECT MAX(Member_ID) AS largestID FROM LibMember;");
			if(res.next()) {
				newID = (res.getInt(1));
			}
			newID++;
			System.out.println("Got new ID number:"+newID);
			String query = "insert into LibMember (Member_Fname, Member_Lname, Member_Id, Address, MState, Mcity, MCountry, MLibary) VALUES ('"+fname+"','"+lname+"','"+newID+"','"+add+"','"+state+"','"+city+"','"+country+"','"+libID+"');";
	   		Statement stmt=con.createStatement(); 
	   		stmt.executeUpdate(query); 
	   		con.close();
		}catch(Exception e){System.out.println(e);} 
	}
	public static void dropEmployee(String id) {
		
		System.out.println("Droping Employee:"+id);
		try {
			Class.forName("com.mysql.cj.jdbc.Driver");  
			Connection con=DriverManager.getConnection("jdbc:mysql://localhost:3306/library","root","1qaz2wsx!QAZ@WSX"); 
	   		String query = "DELETE FROM employee WHERE Employee_SSN = ('"+id+"');";
	   		Statement stmt=con.createStatement(); 
	   		stmt.executeUpdate(query); 
	   		con.close();
		}catch(Exception e){System.out.println(e);} 
	}
	public static void dropMember(String id) {
		

		int z =Integer.parseInt(id);
		System.out.println("Dropping Member Id:"+id);
		try {
			Class.forName("com.mysql.cj.jdbc.Driver");  
			Connection con=DriverManager.getConnection("jdbc:mysql://localhost:3306/library","root","1qaz2wsx!QAZ@WSX"); 
	   		String query = "DELETE FROM LibMember WHERE Member_ID = ('"+z+"');";
	   		Statement stmt=con.createStatement(); 
	   		stmt.executeUpdate(query); 
	   		con.close();
		}catch(Exception e){System.out.println(e);} 
	}
}