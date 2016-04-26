<?xml version="1.0" encoding="ISO-8859-1"?>
<xsl:transform version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform" xmlns:date="http://exslt.org/dates-and-times">

    <xsl:output method="xml" omit-xml-declaration="yes" indent="yes"/> 
    
    <xsl:template match="/">
        <xsl:choose>    
            <xsl:when test="$tag = 'news'">
                <xsl:choose> 
                    <xsl:when test="$action = 'count'">
                        <xsl:call-template name="articlesCount"/>
                    </xsl:when>       
                    <xsl:when test="$action = 'articlesRange'">
                        <xsl:call-template name="articlesRange"/>
                    </xsl:when>    
                    <xsl:when test="$action = 'articlesRangeAbstract'">
                        <xsl:call-template name="articlesRangeAbstract"/>
                    </xsl:when>                                                    
                    <xsl:when test="$action = 'all'">
                        <xsl:apply-templates select="/dewindhappers/news"/>
                    </xsl:when>
                </xsl:choose> 
            </xsl:when> 
            <xsl:when test="$tag = 'disciplines'">  
                <xsl:choose> 
                    <xsl:when test="$action = 'disciplineByName'">
                        <xsl:call-template name="disciplineByName"/>
                    </xsl:when>     
                    <xsl:when test="$action = 'disciplineMenu'">
                        <xsl:call-template name="disciplineMenu"/>
                    </xsl:when>                        
                </xsl:choose>             
            </xsl:when> 
            <xsl:when test="$tag = 'menu'">  
                <xsl:choose> 
                    <xsl:when test="$action = 'menu'">
                        <xsl:apply-templates select="/dewindhappers/menu"/>
                    </xsl:when>       
                </xsl:choose>             
            </xsl:when>                                     
        </xsl:choose>    
    </xsl:template>
        
    <xsl:template name="articlesCount">
        <xsl:value-of select="count(/dewindhappers/news/article)"/>
    </xsl:template>    

    <xsl:template name="articlesRange">
        <div id="news">    
            <xsl:for-each select="/dewindhappers/news/article">
                <xsl:sort select="datetime" order="ascending"/>   
                <xsl:variable name="dateToday" select="translate(substring-before(date:date-time(), 'T'), '-', '')"/>
                <xsl:variable name="dateArticle" select="translate(substring-before(datetime, 'T'), '-', '')"/>           
                <xsl:if test="$dateArticle &gt;= $dateToday and position() &gt; $positionStart and position() &lt;= $positionEnd">
                    <xsl:call-template name="article"/>  
                </xsl:if>               
            </xsl:for-each>
        </div>        
    </xsl:template>
    
    <xsl:template name="articlesRangeAbstract">
        <div id="newsAbstracts">    
            <xsl:for-each select="/dewindhappers/news/article">
                <xsl:sort select="datetime" order="ascending"/>   
                <xsl:variable name="dateToday" select="translate(substring-before(date:date-time(), 'T'), '-', '')"/>
                <xsl:variable name="dateArticle" select="translate(substring-before(datetime, 'T'), '-', '')"/>          
                <xsl:variable name="siblingsAndSelfCount" select="count(preceding-sibling::*|self|following-sibling::*)"/>                
                <xsl:if test="$dateArticle &gt;= $dateToday and $siblingsAndSelfCount - position() + 1 &gt;= $positionStart and $siblingsAndSelfCount - position() &lt; $positionEnd">
                    <xsl:call-template name="articleAbstract"/>  
                </xsl:if>               
            </xsl:for-each>
        </div>        
    </xsl:template>    
    
    <xsl:template name="articleAbstract"> 
        <article>
            <xsl:attribute name="id">
                <xsl:value-of select="position()"/>
            </xsl:attribute>
            <h1><xsl:value-of select="title"/></h1>
            <em><xsl:value-of select="abstract"/></em>
            <xsl:choose>             
                <xsl:when test="a[position() = 1]/img">            
                    <xsl:copy-of select="a[position() = 1]"/>
                </xsl:when>
                <xsl:otherwise>    
                    <xsl:apply-templates select="section[position() = 1]/img[position() = 1]"/>                                          
               </xsl:otherwise>                        
            </xsl:choose>
            <a href="?action=news#{position()}" title="Lees verder">lees verder</a>            
        </article>    
    </xsl:template>     
    
    <xsl:template match="news">
        <div id="news">
            <xsl:for-each select="article">
                <xsl:sort select="datetime" order="ascending"/> 
                <xsl:variable name="dateToday" select="translate(substring-before(date:date-time(), 'T'), '-', '')"/>
                <xsl:variable name="dateArticle" select="translate(substring-before(datetime, 'T'), '-', '')"/>                  
                <xsl:if test="$dateArticle &gt;= $dateToday">                 
                    <xsl:call-template name="article"/> 
                </xsl:if>                               
            </xsl:for-each>
        </div>
    </xsl:template>
    
    <xsl:template name="article"> 
        <article>
            <xsl:attribute name="id">
                <xsl:value-of select="position()"/>
            </xsl:attribute>
            <h1><xsl:value-of select="title"/></h1>
            <em><xsl:copy-of select="abstract/text() | abstract/*"/></em>
            <xsl:for-each select="section">
                <section class="justify-all-lines">
                    <h2><xsl:value-of select="title"/></h2>
                    <xsl:for-each select="img | paragraph | table">
                        <xsl:apply-templates select="."/>
                    </xsl:for-each>
                </section>
            </xsl:for-each>
            <xsl:for-each select="a">          
                <xsl:copy-of select="." />
            </xsl:for-each>    
            <xsl:for-each select="footer">          
                <xsl:copy-of select="." />
            </xsl:for-each>                       
        </article>    
    </xsl:template>  
    
    <xsl:template match="paragraph">
        <p><xsl:copy-of select="node()"/></p>  
    </xsl:template>       
    
    <xsl:template match="table">
        <xsl:copy-of select="."/>     
    </xsl:template>       
    
    <xsl:template match="img">
        <a>
            <xsl:attribute name="href">
                <xsl:value-of select="@src"/>
            </xsl:attribute>   
            <xsl:attribute name="title">
                <xsl:value-of select="@title"/>
            </xsl:attribute>                                                 
            <xsl:attribute name="rel">lightbox[news]</xsl:attribute> 
            <img>
                <xsl:attribute name="src">
                    <xsl:value-of select="@src"/>
                </xsl:attribute>
                <xsl:attribute name="alt">
                    <xsl:value-of select="@alt"/>
                </xsl:attribute>
                <xsl:attribute name="title">
                    <xsl:value-of select="@title"/>
                </xsl:attribute>
            </img>
        </a>    
    </xsl:template>            
    
    <xsl:template name="disciplineByName" > 
        <xsl:apply-templates select="/dewindhappers/disciplines/discipline[normalize-space(name/text()) = $name]"/>
    </xsl:template>    
    
    <xsl:template match="discipline"> 
        <article id="discipline">
            <h1><xsl:value-of select="name"/></h1>
            <section>
                <xsl:copy-of select="description/node()"/>
            </section>    
            <section class="justify-all-lines">
                <xsl:for-each select="image">
                    <a>
                        <xsl:attribute name="href">
                            <xsl:value-of select="url"/>
                        </xsl:attribute>   
                        <xsl:attribute name="title">
                            <xsl:value-of select="title"/>
                        </xsl:attribute>                                                 
                        <xsl:attribute name="rel">lightbox[discipline]</xsl:attribute> 
                        <img>
                            <xsl:attribute name="src">
                                <xsl:value-of select="url"/>
                            </xsl:attribute>
                            <xsl:attribute name="alt">
                                <xsl:value-of select="title"/>
                            </xsl:attribute>
                            <xsl:attribute name="title">
                                <xsl:value-of select="title"/>
                            </xsl:attribute>
                        </img>
                    </a>
                </xsl:for-each>
            </section>
        </article> 
    </xsl:template>  
    
    <xsl:template match="menu">
        <ul id="menu" class="nav">    
            <xsl:apply-templates select="menuItem[alignment = 'left']"/>  
            <xsl:apply-templates select="menuItem[alignment = 'right']"/>           
        </ul>        
    </xsl:template>    
    
    <xsl:template match="menuItem"> 
        <li>
            <xsl:if test="id">
                    <xsl:attribute name="id">
                        <xsl:value-of select="id"/>
                    </xsl:attribute>              
            </xsl:if>         
            <xsl:if test="alignment/text() = 'right'">
                <xsl:attribute name="class">rightitem</xsl:attribute> 
            </xsl:if>           
            <a>         
                <xsl:if test="url">       
                    <xsl:attribute name="href">
                        <xsl:value-of select="url"/>
                    </xsl:attribute>   
                </xsl:if>           
                <xsl:value-of select="name"/>
            </a>  
            <xsl:if test="menuItem">
                <ul>
                    <xsl:apply-templates select="menuItem"/> 
                </ul>
            </xsl:if>                                 
        </li>    
    </xsl:template>    
    
    <xsl:template name="disciplineMenu"> 
        <ul>
            <xsl:for-each select="/dewindhappers/disciplines/discipline">
                <li>          
                    <a>    
                        <xsl:attribute name="href">
                            <xsl:value-of select="concat('?action=discipline&amp;name=', normalize-space(name))"/>
                        </xsl:attribute> 
                        <xsl:value-of select="name"/>
                    </a>                                  
                </li> 
            </xsl:for-each>
        </ul>
    </xsl:template>   

</xsl:transform>
