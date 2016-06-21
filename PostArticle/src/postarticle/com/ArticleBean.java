package postarticle.com;

import java.sql.SQLException;
import java.util.List;

import javax.faces.bean.ManagedBean;
import javax.faces.context.FacesContext;

@ManagedBean(name="articlebean")
public class ArticleBean {
	
	private Article article = new Article();
	private Comments comment = new Comments();
	
	public ArticleBean(){
		
	}
	
	public Article getArticle() {
		return article;
	}

	public void setArticle(Article article) {
		this.article = article;
	}
	
	public Comments getComment() {
		return comment;
	}

	public void setComment(Comments comment) {
		this.comment = comment;
	}
	
	public String processSave() throws ClassNotFoundException, SQLException{
		ArticleService articleService = new ArticleService();
		String articleNumber = articleService.savetoFile(article.getContent());
		article.setArticleId(articleNumber);
		articleService.saveArticle(article);
		return "test";
	}
	
	public String processSaveComment() throws ClassNotFoundException, SQLException{
		System.out.println("herererere");
		return null;
	}
	
	public List<Article> getArticleList() throws SQLException{
		ArticleService articleService = new ArticleService();
		return articleService.retrieve();
	}
	
	public List<Article> getArticleItem() throws SQLException{
		ArticleService articleService = new ArticleService();
		FacesContext context = FacesContext.getCurrentInstance();
		String articleId = context.getExternalContext().getRequestParameterMap().get("articleId");
		return articleService.retrieveById(articleId);
	}
	
	public List<Comments> getcomments(){
		ArticleService articleService = new ArticleService();
		FacesContext context = FacesContext.getCurrentInstance();
		String aid = context.getExternalContext().getRequestParameterMap().get("articleId");
		
		try {
			return articleService.retrieveComments(aid);
		} catch (SQLException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
		return null;
	}
	
}
