package postarticle.com;


import java.io.BufferedWriter;
import java.io.File;
import java.io.FileWriter;
import java.io.IOException;
import java.io.Writer;
import java.nio.charset.Charset;
import java.nio.file.*;
import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import java.text.DateFormat;
import java.text.DecimalFormat;
import java.text.SimpleDateFormat;
import java.util.ArrayList;
import java.util.Date;
import java.util.List;
import java.util.UUID;

public class ArticleService {
public String saveArticle(Article art) throws SQLException, ClassNotFoundException {
		
        Connection con = null;
        try {
            Class.forName ("oracle.jdbc.driver.OracleDriver");
        } catch (ClassNotFoundException ex) {
           
        }
        try {
            con = DriverManager.getConnection (
                    "jdbc:oracle:thin:@apollo.ite.gmu.edu:1521:ite10g",
                    "sshres18", "esoals");
        } catch (SQLException ex) {
            
        }
     	
        DateFormat dateFormat = new SimpleDateFormat("dd-MMM-yyyy");
 	    Date date = new Date();
 	    String insertstmt = "INSERT INTO Articles VALUES('"+
        		        art.getArticleId()+"','','"+
        		        dateFormat.format(date)+"','"+art.getTitle()+"')";
                 
        Statement statement = con.createStatement();
        statement.executeUpdate(insertstmt);
        return "index";
    }
    
public String saveComment(Comments comment) throws SQLException, ClassNotFoundException {
	
    Connection con = null;
    try {
        Class.forName ("oracle.jdbc.driver.OracleDriver");
    } catch (ClassNotFoundException ex) {
       
    }
    try {
        con = DriverManager.getConnection (
                "jdbc:oracle:thin:@apollo.ite.gmu.edu:1521:ite10g",
                "sshres18", "esoals");
    } catch (SQLException ex) {
        
    }
 	 
    String insertstmt = "INSERT INTO COMMENTS VALUES("
              +comment.getArticleId()+","
             + "'"+comment.getCommentContent()+"',"
            + "'"+comment.getCommentBy()+"')";
    System.out.println(insertstmt);
    Statement statement = con.createStatement();
    statement.executeUpdate(insertstmt);
    return "index";
}

public List<Comments> retrieveComments(String aid) throws SQLException{
	List<Comments> list = new ArrayList<Comments>();
	Connection con = null;
	PreparedStatement ps = null;
	ResultSet rs = null;
    try {
        Class.forName ("oracle.jdbc.driver.OracleDriver");
    } catch (ClassNotFoundException ex) {
       
    }
    try {
        con = DriverManager.getConnection (
                "jdbc:oracle:thin:@apollo.ite.gmu.edu:1521:ite10g",
                "sshres18", "esoals");
    } catch (SQLException ex) {
        
    }
    
    
    String sql = "SELECT * FROM COMMENTS WHERE articleId='"+aid+"'";
    ps= con.prepareStatement(sql); 
    rs= ps.executeQuery(); 
    while (rs.next())
    {
    Comments st = new Comments();
    st.setCommentDate(rs.getDate("COMMENTDATE").toString());;
    st.setArticleId(rs.getString("ARTICLEID"));
    st.setCommentContent(rs.getString("COMMENTCONTENT"));
    st.setCommentBy(rs.getString("COMMENTBY"));
    list.add(st);
    } 
    return list;
}
    public List<Article> retrieve() throws SQLException{
    	List<Article> list = new ArrayList<Article>();
    	Connection con = null;
    	PreparedStatement ps = null;
    	ResultSet rs = null;
        try {
            Class.forName ("oracle.jdbc.driver.OracleDriver");
        } catch (ClassNotFoundException ex) {
           
        }
        try {
            con = DriverManager.getConnection (
                    "jdbc:oracle:thin:@apollo.ite.gmu.edu:1521:ite10g",
                    "sshres18", "esoals");
        } catch (SQLException ex) {
            
        }
        
        
        String sql = "SELECT * FROM ARTICLES";
        ps= con.prepareStatement(sql); 
        rs= ps.executeQuery(); 
        while (rs.next())
        {
        Article st = new Article();
        st.setArticleDate(rs.getDate("ARTICLEDATE").toString());
        st.setArticleId(rs.getString("ARTICLEID"));
        st.setTitle(rs.getString("ARTICLETITLE"));
        list.add(st);
        } 
        return list;
    }
	
    public List<Article> retrieveById(String articleId) throws SQLException{
    	List<Article> list = new ArrayList<Article>();
    	Connection con = null;
    	PreparedStatement ps = null;
    	ResultSet rs = null;
        try {
            Class.forName ("oracle.jdbc.driver.OracleDriver");
        } catch (ClassNotFoundException ex) {
           
        }
        try {
            con = DriverManager.getConnection (
                    "jdbc:oracle:thin:@apollo.ite.gmu.edu:1521:ite10g",
                    "sshres18", "esoals");
        } catch (SQLException ex) {
            
        }
        
        
        String sql = "SELECT * FROM ARTICLES WHERE articleId='"+articleId+"'";
        
        ps= con.prepareStatement(sql); 
        rs= ps.executeQuery(); 
        while (rs.next())
        {
        Article st = new Article();
        st.setArticleDate(rs.getDate("ARTICLEDATE").toString());
        st.setArticleId(rs.getString("ARTICLEID"));
        st.setTitle(rs.getString("ARTICLETITLE"));
        list.add(st);
        } 
        return list;
    }
    
	public String savetoFile(String contents){
		UUID ud = UUID.randomUUID();
		
		try {
			File file = new File("Articles/../tester.txt");

			// if file doesnt exists, then create it
			if (!file.exists()) {
				file.createNewFile();
			}

			FileWriter fw = new FileWriter(file.getAbsoluteFile());
			BufferedWriter bw = new BufferedWriter(fw);
			bw.write(contents);
			bw.close();

		} catch (IOException e) {
			e.printStackTrace();
		}
		return ud.toString();
	}

	
}
