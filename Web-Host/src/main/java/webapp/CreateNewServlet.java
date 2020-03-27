package webapp;

import java.io.IOException;
import java.io.PrintWriter;

import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.ResultSet;
import java.sql.Statement;
import java.util.Scanner;


@WebServlet(urlPatterns = "/CreateNew.do")
public class CreateNewServlet extends HttpServlet {

	public static int empId;
	public static String empSSN;
	public static String[] books;
	
	protected void doGet(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
		PrintWriter out = response.getWriter();
		
		request.setAttribute("name",request.getParameter("name"));
		request.setAttribute("password",request.getParameter("password"));
		
		request.getRequestDispatcher("/WEB-INF/views/login.jsp").forward(request, response);

	}
	protected void doPost(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
		PrintWriter out = response.getWriter();
		
		String emp = request.getParameter("name");
		String mem = request.getParameter("password");
		
		System.out.println("New User Page");
		if (request.getParameter("newEmp") != null) {
			//Database create new stuff
			String fname = request.getParameter("fname");
			String lname = request.getParameter("lname");
			String ssn = request.getParameter("ssn");
			String job = request.getParameter("job");
			String hours = request.getParameter("hours");
			String libID = request.getParameter("libID");
			DatabaseConnector.CreateEmployee(fname,lname,ssn,job,hours,libID);
			request.getRequestDispatcher("/WEB-INF/views/login.jsp").forward(request, response);
			}
		else if (request.getParameter("newMem") != null) {
			//Database create new stuff
			String fname = request.getParameter("fname");
			String lname = request.getParameter("lname");
			String add = request.getParameter("add");
			String state = request.getParameter("state");
			String city = request.getParameter("city");
			String country = request.getParameter("country");
			String libID = request.getParameter("libID");
			DatabaseConnector.CreateMember(fname,lname,add,state,city,country,libID);
			request.getRequestDispatcher("/WEB-INF/views/login.jsp").forward(request, response);
			}
		else if (request.getParameter("emp") != null) {
			request.getRequestDispatcher("/WEB-INF/views/NewEmployee.jsp").forward(request, response);
			}
		else if (request.getParameter("mem") != null) {
			request.getRequestDispatcher("/WEB-INF/views/NewMember.jsp").forward(request, response);
		}else {
			request.getRequestDispatcher("/WEB-INF/views/login.jsp").forward(request, response);
		}

	}

}