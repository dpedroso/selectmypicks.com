	
	function loadXMLString(txt){
		if (window.DOMParser){
		  parser=new DOMParser();
		  xmlDoc=parser.parseFromString(txt,"text/xml");
		}
		else{ // code for IE
			xmlDoc=new ActiveXObject("Microsoft.XMLDOM");
			xmlDoc.async=false;
			xmlDoc.loadXML(txt);
		}
		return xmlDoc;
	}

	function xml_to_string(xml_node){
		if (xml_node.xml)
			return xml_node.xml;
		else if (XMLSerializer){
			var xml_serializer = new XMLSerializer();
			return xml_serializer.serializeToString(xml_node);
		}
		else{
			alert("ERROR: Extremely old browser");
			return "";
		}
	}