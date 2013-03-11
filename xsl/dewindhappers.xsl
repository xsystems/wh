<?xml version="1.0" encoding="ISO-8859-1"?>
<xsl:transform version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

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
                        <xsl:apply-templates match="news"/>
                    </xsl:when>
                </xsl:choose> 
            </xsl:when>    
        </xsl:choose>    
    </xsl:template>
        
    <xsl:template name="articlesCount">
        <xsl:value-of select="count(//article)"/>
    </xsl:template>    

    <xsl:template name="articlesRange">
        <div id="news">    
            <xsl:for-each select="//article">
                <xsl:sort select="datetime" order="descending"/>   
                <xsl:if test="position() &gt; $positionStart and position() &lt;= $positionEnd">
                    <xsl:apply-templates select="."/>  
                </xsl:if>               
            </xsl:for-each>
        </div>        
    </xsl:template>
    
    <xsl:template name="articlesRangeAbstract">
        <div id="newsAbstracts">    
            <xsl:for-each select="//article">
                <xsl:sort select="datetime" order="descending"/>   
                <xsl:if test="position() &gt; $positionStart and position() &lt;= $positionEnd">
                    <xsl:call-template name="articleAbstract"/>  
                </xsl:if>               
            </xsl:for-each>
        </div>        
    </xsl:template>    
    
    <xsl:template name="articleAbstract"> 
        <article>
            <xsl:attribute name="id">
                <xsl:value-of select="generate-id()"/>
            </xsl:attribute>
            <h1><xsl:value-of select="title"/></h1>
            <em><xsl:value-of select="abstract"/></em>
            <xsl:if test="local-name(.//img) = 'img'">            
                <a>
                    <xsl:attribute name="href">
                        <xsl:value-of select=".//img/@src"/>
                    </xsl:attribute>   
                    <xsl:attribute name="title">
                        <xsl:value-of select=".//img/@title"/>
                    </xsl:attribute>                                                 
                    <xsl:attribute name="rel">lightbox[news]</xsl:attribute> 
                    <img>
                        <xsl:attribute name="src">
                            <xsl:value-of select=".//img/@src"/>
                        </xsl:attribute>
                        <xsl:attribute name="alt">
                            <xsl:value-of select=".//img/@alt"/>
                        </xsl:attribute>
                        <xsl:attribute name="title">
                            <xsl:value-of select=".//img/@title"/>
                        </xsl:attribute>
                    </img>
                </a>
            </xsl:if>                           
            <a href="?action=news#{generate-id()}" title="Lees verder">lees verder</a>            
        </article>    
    </xsl:template>     
    
    <xsl:template match="news">
        <div id="news">
            <xsl:apply-templates select="articles"/>
        </div>
    </xsl:template>    

    <xsl:template match="articles">
        <xsl:for-each select="article">
            <xsl:sort select="datetime" order="descending"/>   
                <xsl:apply-templates select="."/>  
        </xsl:for-each>
    </xsl:template>
    
    <xsl:template match="article"> 
        <article>
            <xsl:attribute name="id">
                <xsl:value-of select="generate-id()"/>
            </xsl:attribute>
            <h1><xsl:value-of select="title"/></h1>
            <em><xsl:copy-of select="abstract/text() | abstract/*"/></em>
            <xsl:for-each select="section">
                <section>
                    <h2><xsl:value-of select="title"/></h2>
                    <xsl:for-each select="paragraph">
                        <p><xsl:copy-of select="./text() | ./*"/></p>
                    </xsl:for-each>
                    <xsl:for-each select="img">
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

</xsl:transform>
