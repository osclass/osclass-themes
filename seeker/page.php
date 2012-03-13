<?php
    /*
     *      OSCLass – software for creating and publishing online classified
     *                           advertising platforms
     *
     *                        Copyright (C) 2010 OSCLASS
     *
     *       This program is free software: you can redistribute it and/or
     *     modify it under the terms of the GNU Affero General Public License
     *     as published by the Free Software Foundation, either version 3 of
     *            the License, or (at your option) any later version.
     *
     *     This program is distributed in the hope that it will be useful, but
     *         WITHOUT ANY WARRANTY; without even the implied warranty of
     *        MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
     *             GNU Affero General Public License for more details.
     *
     *      You should have received a copy of the GNU Affero General Public
     * License along with this program.  If not, see <http://www.gnu.org/licenses/>.
     */
?>
<?php osc_current_web_theme_path('header.php') ; ?>
<div id="page-content">
	<?php /* <h1>Header one</h1>
<h2>Header two</h2>
<h3>Header three</h3>
<h4>Header four</h4>
<h5>Header five</h5>
<h6>Header six</h6>

<h2>Blockquote Tests</h2>
Blockquote:
<blockquote>Here's a one line quote.</blockquote>
This part isn't quoted.  Here's a longer quote:
<blockquote>It’s like a language. You learn the alphabet, which are the scales. You learn sentences, which are the chords. And then you talk extemporaneously with the horn. It’s a wonderful thing to speak extemporaneously, which is something I’ve never gotten the hang of. But musically I love to talk just off the top of my head. And that’s what jazz music is all about.

<cite>Stan Getz</cite></blockquote>
And some trailing text.

<h2>Table Layout Test</h2>
<table class="statsDay">
<tbody>
<tr>
<th>Title</th>
<th class="views">Views</th>
<th></th>
</tr>
<tr class="alternate">
<td class="label"><a href="http://wpthemetestdata.wordpress.com/about/" rel="nofollow">About Test User</a></td>
<td class="views">1</td>
<td class="more">More</td>
</tr>
<tr>
<td class="label"><a href="http://wpthemetestdata.wordpress.com/" rel="nofollow">260</a></td>
<td class="views">1</td>
<td class="more">More</td>
</tr>
<tr class="alternate">
<td class="label"><a href="http://wpthemetestdata.wordpress.com/archives/" rel="nofollow">Archives</a></td>
<td class="views">1</td>
<td class="more">More</td>
</tr>
<tr>
<td class="label"><a href="http://wpthemetestdata.wordpress.com/" rel="nofollow">235</a></td>
<td class="views">1</td>
<td class="more">More</td>
</tr>
</tbody>
</table>
<h2>List Type Tests</h2>
<h3>Definition List</h3>
<dl> <dt>Definition List Title</dt> <dd>This is a definition list division.</dd> <dt>Definition</dt> <dd>An exact statement or description of the nature, scope, or meaning of something: <em>our definition of what constitutes poetry.</em></dd> <dt>Gallery</dt> <dd>A feature introduced with WordPress 2.5, that is specifically an exposition of images attached to a post. In that same vein, an upload is "attached to a post" when you upload it while editing a post.</dd> <dt>Gravatar</dt> <dd>A globally recognized avatar (a graphic image or picture that represents a user). A gravatar is associated with an email address, and is maintained by the Gravatar.com service. Using this service, a blog owner can configure their blog so that a user's gravatar is displayed along with their comments.</dd> </dl>
<h3>Unordered List (Nested)</h3>
<ul>
	<li>List item one
<ul>
	<li>List item one
<ul>
	<li>List item one</li>
	<li>List item two</li>
	<li>List item three</li>
	<li>List item four</li>
</ul>
</li>
	<li>List item two</li>
	<li>List item three</li>
	<li>List item four</li>
</ul>
</li>
	<li>List item two</li>
	<li>List item three</li>
	<li>List item four</li>
</ul>
<h3>Ordered List</h3>
<ol>
	<li>List item one
<ol>
	<li>List item one
<ol>
	<li>List item one</li>
	<li>List item two</li>
	<li>List item three</li>
	<li>List item four</li>
</ol>
</li>
	<li>List item two</li>
	<li>List item three</li>
	<li>List item four</li>
</ol>
</li>
	<li>List item two</li>
	<li>List item three</li>
	<li>List item four</li>
</ol>
<h2>HTML Element Tag Tests</h2>
All other HTML tags listed in the <a href="http://en.support.wordpress.com/code/" rel="nofollow">FAQ</a>:

Here is the address for Automattic, using the <code>&lt;address&gt;</code> tag:

<address>355 1st Street Suite 202
San Francisco, CA 94105
United States</address>This is an example of <a href="http://example.com" rel="nofollow">an <code>&lt;anchor&gt;</code></a> (otherwise known as a link). This <abbr title="abbreviation">abbr.</abbr> is an example of an &lt;abbr&gt; tag in the middle of a sentence. Here is a <acronym title="three-letter acronym">TLA</acronym> showing off the <code>&lt;acronym&gt;</code> tag. What, you want to see <big>some over-sized text</big> using the <code>&lt;big&gt;</code> tag? Can you <cite>cite a reference</cite> for that, using the <code>&lt;cite&gt;</code> tag? Have you noticed that all of the tag names are displayed <code>in code-form</code>, using the <code>&lt;code&gt;</code> tag? Similarly, I could <kbd>emulate keyboard text</kbd>, using the <code>&lt;kbd&gt;</code> text tag, or <tt>emulate teletype text</tt> using the <code>&lt;tt&gt;</code> tag.

Oh no! I wrote something incorrectly. <del>I'd better delete it</del>, using the <code>&lt;del&gt;</code> tag. I could alternately <span style="text-decoration:line-through;">strike something out</span> using the <code>&lt;strike&gt;</code> tag, or strike something out using the <code>&lt;s&gt;</code> tag. <em>So many choices</em>, which I emphasize using the <code>&lt;em&gt;</code> tag. Just to clarify, <ins>this is some inserted text</ins>, that I'll highlight using the <code>&lt;ins&gt;</code> tag.

Need to display completely unformatted text, such as a large block of code? Use the <code>&lt;pre&gt;</code> tag, which lets you display:
<pre>#container {
	float: left;
	margin: 0 -240px 0 0;
	width: 100%;
}</pre>
Want to quote the WordPress tagline <q>Code is Poetry</q>? Use the <code>&lt;q&gt;</code> tag to add quotes around it. <strong>This is strong text</strong> (otherwise known as bold), using the <code>&lt;strong&gt;</code> tag.

Need to write H<sub>2</sub>O or E = MC<sup>2</sup>? You may find great use for <sub>subscripting</sub> text using the <code>&lt;sub&gt;</code> tag, or for <sup>superscripting</sup> text using the <code>&lt;sup&gt;</code> tag. Need to call out a <var>variable</var>? Use the <code>&lt;var&gt;</code> tag.
<h2>Div and Span Tests</h2>
<div>

Lorem ipsum dolor sit amet, consectetuer adipiscing elit.
<div class="myclass"><strong>This is a div with "myclass" class, inside of another div, using the <code>&lt;div&gt;</code> tag.</strong></div>
Sed odio nibh, tincidunt adipiscing, pretium nec, tincidunt id, enim. Fusce scelerisque nunc vitae nisl.

</div>
Lorem ipsum dolor sit amet, consectetuer adipiscing elit. <span><strong>This is a span inside of a paragraph, using the <code>&lt;span&gt;</code> tag.</strong></span> Sed odio nibh, tincidunt adipiscing, pretium nec, tincidunt id, enim. Fusce scelerisque nunc vitae nisl.*/ ?>
	<h1><?php echo osc_static_page_title() ; ?></h1>
	<div><?php echo osc_static_page_text() ; ?></div>
</div>
<?php osc_current_web_theme_path('footer.php') ; ?>