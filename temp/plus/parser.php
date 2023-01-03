<?php
 
function post2https($fields,$url)
{
	
	$ch = curl_init();
	
	
	curl_setopt($ch,CURLOPT_URL,$url);
	curl_setopt($ch,CURLOPT_POST,true);
	var_dump($fields);
	curl_setopt($ch,CURLOPT_POSTFIELDS,$fields);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
	
	
	
	$res = curl_exec($ch);
	
	
	curl_close($ch);
	return $res;
}

class MyXML
{
    protected $data  ;
    function __construct( $xml )
    {
        $parser = xml_parser_create();
        xml_parser_set_option( $parser, XML_OPTION_CASE_FOLDING, 0 );
        xml_parser_set_option( $parser, XML_OPTION_SKIP_WHITE, 1 );
        xml_parse_into_struct( $parser, $xml, $tags );
        xml_parser_free( $parser );

        $elements = array();
        $stack = array();
        foreach ( $tags as $tag )
        {
            $index = count( $elements );
            if ( $tag['type'] == "complete" || $tag['type'] == "open" )
            {
                $elements[$index] = array();
                $elements[$index]['name'] = $tag['tag'];
                if(isset($tag['attributes']))
                    $elements[$index]['attributes'] = $tag['attributes'];
                if(isset($tag['value']))
                    $elements[$index]['content'] = $tag['value'];

                if ( $tag['type'] == "open" )
                {    
                    $elements[$index]['children'] = array();
                    $stack[count($stack)] = &$elements;
                    $elements = &$elements[$index]['children'];
                }
            }

            if ( $tag['type'] == "close" )
            {    
                $elements = &$stack[count($stack) - 1];
                unset($stack[count($stack) - 1]);
            }
        }
        $this->data = $elements[0];
    }
    public function __get($aName)
    {
        foreach($this->data['children'] as $node)
            if(strtoupper($node['name']) == strtoupper ($aName))
                return $node['content'];
        return '';
    }
}