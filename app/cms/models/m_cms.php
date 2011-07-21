<?php

/*
	CMS Class
	Handle CMS tasks, allowing admins to view/edit content
*/

class Cms
{
	private $content_types = array('wysiwyg', 'textarea', 'oneline');
	private $page_content_ids = array();
	private $FP;
	
	function __construct()
	{
		global $FP;
		$this->FP = &$FP;
	} 
	
	//TODO when previewing page, need to be able to access other pages (not edit window)
	function display_pagelinks()
	{
		if ($stmt = $this->FP->Database->prepare("SELECT id,name FROM pages"))
			{
				$stmt->execute();
				$stmt->store_result();
				
				if ($stmt->num_rows != FALSE)
				{
					$stmt->bind_result($id, $page);
					$pages = array();
					
					while ($stmt->fetch())
					{
						$pages[$id] = $page;
					}
					
					$stmt->close();

					$pagelinks = "<ul id='nav'>";
					foreach ($pages as $id=>$page) 
					{	
						if ($this->FP->Auth->checkLoginStatus())
						{ 
							$pagelinks .= "<li class='fp_editpage'><a class='fp_editpage_link' href='app/cms/editpage.php?pid=$id'>$page</a></li>"; 
						}
						else 
						{
							$pagelinks .= "<li><a href='?pid=$id'>$page</a></li>";
						}
					}
					if ($this->FP->Auth->checkLoginStatus())
					{
						$pagelinks .= "<li id='newpage'><a class='fp_addpage' href='app/cms/addpage.php'>+</a></li>";					
					}
					$pagelinks .= "</ul>";				
					echo $pagelinks;
				}
				else
				{
					$stmt->close();
					return FALSE;
				}
			}
	}
	
	function display_block($page_id, $content_id, $content_type = 'wysiwyg')
	{
		$this->get_page_content($page_id);

		$this->page_content_ids[$content_id];
		
		// check for valid type
		$content_type = strtolower(htmlentities($content_type, ENT_QUOTES));
		
		// TODO - ensure $this->content_types picks up all content types from the DB
		if (in_array($content_type, $this->content_types) == FALSE)
		{
			echo "<script>alert('Please enter a valid block type for \'" . $content_id . "\'');</script>";
			return;
		}
		
		$content = $this->load_block($page_id, $this->page_content_ids[$content_id]);
		if ($content === FALSE)
		{
			// TODO - uncomment this when ready
			// create content
			//$this->create_block($page_id, $content_id);
			$content = '';
		}
		
		// check login status
		if ($this->FP->Auth->checkLoginStatus())
		{
			if($content_type == 'wysiwyg') { $content_type2 = 'WYSIWYG'; }
			if($content_type == 'textarea') { $content_type2 = 'Textarea'; }
			if($content_type == 'oneline') { $content_type2 = 'One Line'; }
			
			$edit_start = '<div class="fp_edit">';
			$edit_type = '<a class="fp_edit_type" href="' . SITE_PATH . 'app/cms/edit.php?id='
				. $this->page_content_ids[$content_id] . '&type=' . $content_type . '">' . $content_type2 . '</a>';
			$edit_link = '<a class="fp_edit_link" href="' . SITE_PATH . 'app/cms/edit.php?id='
				. $this->page_content_ids[$content_id] . '&type=' . $content_type . '">Edit Block</a>';
			$edit_end = '</div>';
			
			echo $edit_start . $edit_type;
			echo $edit_link . $content . $edit_end;
		}
		else
		{
			echo $content; 
		}
	}
	
	function generate_field($type, $content)
	{
		if ($type == 'wysiwyg')
		{
			return '<textarea name="field" id="field" class="wysiwyg">' . $content . '</textarea>';
		}
		else if ($type == 'textarea')
		{
			return '<textarea name="field" id="field" class="textarea">' . $content . '</textarea>';
		}
		else if ($type == 'oneline')
		{
			return '<input name="field" id="field" class="oneline" value="'.$content.'">';
		}
		else
		{
			$error = '<p>Please edit the block to use a valid content type:</p><ul>';
			foreach ($this->content_types as $content_type)
			{
				$error .= '<li>' . $content_type . '</li>';
			}
			$error .= '</ul>';
			return $error;
		}
	}
	
	function load_block($page_id, $content_id)
	{
		// get contents from database
		if ($stmt = $this->FP->Database->prepare("SELECT content.content FROM content JOIN page_content ON content.id = page_content.content_id JOIN pages ON page_content.page_id = pages.id WHERE page_content.page_id = ? AND page_content.content_id = ? LIMIT 1"));
		{
			$stmt->bind_param('ii', $page_id, $content_id);
			$stmt->execute();
			$stmt->store_result();
			
			if ($stmt->num_rows != FALSE)
			{
				$stmt->bind_result($content);
				$stmt->fetch();
				$stmt->close();
				return $content;
			}
			else
			{
				$stmt->close();
				return FALSE;
			}
		}
	}
	
	function create_block($page_id, $content_id)
	{
		if ($stmt = $this->FP->Database->prepare("INSERT INTO content (id) VALUES (?)"))
		{
			$stmt->bind_param("s", $page_id);
			$stmt->execute();
			$stmt->close();
		}
	}
	
	function update_block($id, $content)
	{
		if ($stmt = $this->FP->Database->prepare("UPDATE content SET content = ? WHERE id = ?"))
		{
			$stmt->bind_param("ss", $content, $id);
			$stmt->execute();
			$stmt->close();
		}
	}
	
	function create_page($title)
	{
		if ($stmt = $this->FP->Database->prepare("INSERT INTO pages (name) VALUES (?)"))
		{
			$stmt->bind_param("s", $title);
			$stmt->execute();
			$stmt->close();
		}
	}
	
	function edit_page($id)
	{
		if ($stmt = $this->FP->Database->prepare("INSERT INTO pages (name) VALUES (?)"))
		{
			$stmt->bind_param("s", $title);
			$stmt->execute();
			$stmt->close();
		}
	}
	
	function get_pagetitle($id)
	{
		if ($stmt = $this->FP->Database->prepare("SELECT name FROM pages WHERE id = ?"))
		{
			$stmt->bind_param('s', $id);
			$stmt->execute();
			$stmt->store_result();
			
			if ($stmt->num_rows != FALSE)
			{
				$stmt->bind_result($pagetitle);
				$stmt->fetch();
				$stmt->close();
				return $pagetitle;
			}
			else
			{
				$stmt->close();
				return FALSE;
			}
		}
	}
	
	function update_pagetitle($name, $id)
	{
		if ($stmt = $this->FP->Database->prepare("UPDATE pages SET name = ? WHERE id = ?"))
		{
			$stmt->bind_param("ss", $name, $id);
			$stmt->execute();
			$stmt->close();
		}
	}

	//TODO - cms model getting too complex, need to refactor into smaller models
	function get_page_content($page_id)
	{
		if ($stmt = $this->FP->Database->prepare("SELECT content_id FROM page_content WHERE page_id = ?"))
		{
			// TODO - ensure correct data type is being used for bind_param in all cases
			$stmt->bind_param('i', $page_id);
			$stmt->execute();
			$stmt->store_result();
			
			if ($stmt->num_rows != FALSE)
			{
				$stmt->bind_result($content_id);
				while ($stmt->fetch())
				{
					$this->page_content_ids[] = $content_id;
				}
				$stmt->close();
				return;
			}
			else
			{
				$stmt->close();
				return FALSE;
			}
		}	
	}
}
