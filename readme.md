<article>
		<h1>Laravel Socialite</h1>
<ul>
<li><a href="#introduction">Introduction</a></li>
<li><a href="#upgrading-socialite">Upgrading Socialite</a></li>
<li><a href="#installation">Installation</a></li>
<li><a href="#configuration">Configuration</a></li>
<li><a href="#routing">Routing</a></li>
<li><a href="#optional-parameters">Optional Parameters</a></li>
<li><a href="#access-scopes">Access Scopes</a></li>
<li><a href="#stateless-authentication">Stateless Authentication</a></li>
<li><a href="#retrieving-user-details">Retrieving User Details</a></li>
</ul>
<p><a name="introduction"></a></p>
<h2><a href="#introduction">Introduction</a></h2>
<p>In addition to typical, form based authentication, Laravel also provides a simple, convenient way to authenticate with OAuth providers using <a href="https://github.com/laravel/socialite">Laravel Socialite</a>. Socialite currently supports authentication with Facebook, Twitter, LinkedIn, Google, GitHub, GitLab and Bitbucket.</p>
<blockquote class="has-icon">
<p class="tip"><div class="flag"><span class="svg"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:a="http://ns.adobe.com/AdobeSVGViewerExtensions/3.0/" version="1.1" x="0px" y="0px" width="56.6px" height="87.5px" viewBox="0 0 56.6 87.5" enable-background="new 0 0 56.6 87.5" xml:space="preserve"><path fill="#FFFFFF" d="M28.7 64.5c-1.4 0-2.5-1.1-2.5-2.5v-5.7 -5V41c0-1.4 1.1-2.5 2.5-2.5s2.5 1.1 2.5 2.5v10.1 5 5.8C31.2 63.4 30.1 64.5 28.7 64.5zM26.4 0.1C11.9 1 0.3 13.1 0 27.7c-0.1 7.9 3 15.2 8.2 20.4 0.5 0.5 0.8 1 1 1.7l3.1 13.1c0.3 1.1 1.3 1.9 2.4 1.9 0.3 0 0.7-0.1 1.1-0.2 1.1-0.5 1.6-1.8 1.4-3l-2-8.4 -0.4-1.8c-0.7-2.9-2-5.7-4-8 -1-1.2-2-2.5-2.7-3.9C5.8 35.3 4.7 30.3 5.4 25 6.7 14.5 15.2 6.3 25.6 5.1c13.9-1.5 25.8 9.4 25.8 23 0 4.1-1.1 7.9-2.9 11.2 -0.8 1.4-1.7 2.7-2.7 3.9 -2 2.3-3.3 5-4 8L41.4 53l-2 8.4c-0.3 1.2 0.3 2.5 1.4 3 0.3 0.2 0.7 0.2 1.1 0.2 1.1 0 2.2-0.8 2.4-1.9l3.1-13.1c0.2-0.6 0.5-1.2 1-1.7 5-5.1 8.2-12.1 8.2-19.8C56.4 12 42.8-1 26.4 0.1zM43.7 69.6c0 0.5-0.1 0.9-0.3 1.3 -0.4 0.8-0.7 1.6-0.9 2.5 -0.7 3-2 8.6-2 8.6 -1.3 3.2-4.4 5.5-7.9 5.5h-4.1H28h-0.5 -3.6c-3.5 0-6.7-2.4-7.9-5.7l-0.1-0.4 -1.8-7.8c-0.4-1.1-0.8-2.1-1.2-3.1 -0.1-0.3-0.2-0.5-0.2-0.9 0.1-1.3 1.3-2.1 2.6-2.1H41C42.4 67.5 43.6 68.2 43.7 69.6zM37.7 72.5H26.9c-4.2 0-7.2 3.9-6.3 7.9 0.6 1.3 1.8 2.1 3.2 2.1h4.1 0.5 0.5 3.6c1.4 0 2.7-0.8 3.2-2.1L37.7 72.5z"></path></svg></span></div> Adapters for other platforms are listed at the community driven <a href="https://socialiteproviders.github.io/">Socialite Providers</a> website.</p>
</blockquote>
<p><a name="upgrading-socialite"></a></p>
<h2><a href="#upgrading-socialite">Upgrading Socialite</a></h2>
<p>When upgrading to a new major version of Socialite, it's important that you carefully review <a href="https://github.com/laravel/socialite/blob/master/UPGRADE.md">the upgrade guide</a>.</p>
<p><a name="installation"></a></p>
<h2><a href="#installation">Installation</a></h2>
<p>To get started with Socialite, use Composer to add the package to your project's dependencies:</p>
<pre class=" language-php"><code class=" language-php">composer <span class="token keyword">require</span> laravel<span class="token operator">/</span>socialite</code></pre>
<p><a name="configuration"></a></p>
<h2><a href="#configuration">Configuration</a></h2>
<p>Before using Socialite, you will also need to add credentials for the OAuth services your application utilizes. These credentials should be placed in your <code class=" language-php">config<span class="token operator">/</span>services<span class="token punctuation">.</span>php</code> configuration file, and should use the key <code class=" language-php">facebook</code>, <code class=" language-php">twitter</code>, <code class=" language-php">linkedin</code>, <code class=" language-php">google</code>, <code class=" language-php">github</code>, <code class=" language-php">gitlab</code> or <code class=" language-php">bitbucket</code>, depending on the providers your application requires. For example:</p>
<pre class=" language-php"><code class=" language-php"><span class="token string">'github'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token punctuation">[</span>
    <span class="token string">'client_id'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token function">env<span class="token punctuation">(</span></span><span class="token string">'GITHUB_CLIENT_ID'</span><span class="token punctuation">)</span><span class="token punctuation">,</span>
    <span class="token string">'client_secret'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token function">env<span class="token punctuation">(</span></span><span class="token string">'GITHUB_CLIENT_SECRET'</span><span class="token punctuation">)</span><span class="token punctuation">,</span>
    <span class="token string">'redirect'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token string">'http://your-callback-url'</span><span class="token punctuation">,</span>
<span class="token punctuation">]</span><span class="token punctuation">,</span></code></pre>
<blockquote class="has-icon">
<p class="tip"><div class="flag"><span class="svg"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:a="http://ns.adobe.com/AdobeSVGViewerExtensions/3.0/" version="1.1" x="0px" y="0px" width="56.6px" height="87.5px" viewBox="0 0 56.6 87.5" enable-background="new 0 0 56.6 87.5" xml:space="preserve"><path fill="#FFFFFF" d="M28.7 64.5c-1.4 0-2.5-1.1-2.5-2.5v-5.7 -5V41c0-1.4 1.1-2.5 2.5-2.5s2.5 1.1 2.5 2.5v10.1 5 5.8C31.2 63.4 30.1 64.5 28.7 64.5zM26.4 0.1C11.9 1 0.3 13.1 0 27.7c-0.1 7.9 3 15.2 8.2 20.4 0.5 0.5 0.8 1 1 1.7l3.1 13.1c0.3 1.1 1.3 1.9 2.4 1.9 0.3 0 0.7-0.1 1.1-0.2 1.1-0.5 1.6-1.8 1.4-3l-2-8.4 -0.4-1.8c-0.7-2.9-2-5.7-4-8 -1-1.2-2-2.5-2.7-3.9C5.8 35.3 4.7 30.3 5.4 25 6.7 14.5 15.2 6.3 25.6 5.1c13.9-1.5 25.8 9.4 25.8 23 0 4.1-1.1 7.9-2.9 11.2 -0.8 1.4-1.7 2.7-2.7 3.9 -2 2.3-3.3 5-4 8L41.4 53l-2 8.4c-0.3 1.2 0.3 2.5 1.4 3 0.3 0.2 0.7 0.2 1.1 0.2 1.1 0 2.2-0.8 2.4-1.9l3.1-13.1c0.2-0.6 0.5-1.2 1-1.7 5-5.1 8.2-12.1 8.2-19.8C56.4 12 42.8-1 26.4 0.1zM43.7 69.6c0 0.5-0.1 0.9-0.3 1.3 -0.4 0.8-0.7 1.6-0.9 2.5 -0.7 3-2 8.6-2 8.6 -1.3 3.2-4.4 5.5-7.9 5.5h-4.1H28h-0.5 -3.6c-3.5 0-6.7-2.4-7.9-5.7l-0.1-0.4 -1.8-7.8c-0.4-1.1-0.8-2.1-1.2-3.1 -0.1-0.3-0.2-0.5-0.2-0.9 0.1-1.3 1.3-2.1 2.6-2.1H41C42.4 67.5 43.6 68.2 43.7 69.6zM37.7 72.5H26.9c-4.2 0-7.2 3.9-6.3 7.9 0.6 1.3 1.8 2.1 3.2 2.1h4.1 0.5 0.5 3.6c1.4 0 2.7-0.8 3.2-2.1L37.7 72.5z"></path></svg></span></div> If the <code class=" language-php">redirect</code> option contains a relative path, it will automatically be resolved to a fully qualified URL.</p>
</blockquote>
<p><a name="routing"></a></p>
<h2><a href="#routing">Routing</a></h2>
<p>Next, you are ready to authenticate users! You will need two routes: one for redirecting the user to the OAuth provider, and another for receiving the callback from the provider after authentication. We will access Socialite using the <code class=" language-php">Socialite</code> facade:</p>
<pre class=" language-php"><code class=" language-php"><span class="token delimiter">&lt;?php</span>

<span class="token keyword">namespace</span> <span class="token package">App<span class="token punctuation">\</span>Http<span class="token punctuation">\</span>Controllers<span class="token punctuation">\</span>Auth</span><span class="token punctuation">;</span>

<span class="token keyword">use</span> <span class="token package">Socialite</span><span class="token punctuation">;</span>

<span class="token keyword">class</span> <span class="token class-name">LoginController</span> <span class="token keyword">extends</span> <span class="token class-name">Controller</span>
<span class="token punctuation">{</span>
    <span class="token comment" spellcheck="true">/**
     * Redirect the user to the GitHub authentication page.
     *
     * @return \Illuminate\Http\Response
     */</span>
    <span class="token keyword">public</span> <span class="token keyword">function</span> <span class="token function">redirectToProvider<span class="token punctuation">(</span></span><span class="token punctuation">)</span>
    <span class="token punctuation">{</span>
        <span class="token keyword">return</span> <span class="token scope">Socialite<span class="token punctuation">::</span></span><span class="token function">driver<span class="token punctuation">(</span></span><span class="token string">'github'</span><span class="token punctuation">)</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">redirect<span class="token punctuation">(</span></span><span class="token punctuation">)</span><span class="token punctuation">;</span>
    <span class="token punctuation">}</span>

    <span class="token comment" spellcheck="true">/**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */</span>
    <span class="token keyword">public</span> <span class="token keyword">function</span> <span class="token function">handleProviderCallback<span class="token punctuation">(</span></span><span class="token punctuation">)</span>
    <span class="token punctuation">{</span>
        <span class="token variable">$user</span> <span class="token operator">=</span> <span class="token scope">Socialite<span class="token punctuation">::</span></span><span class="token function">driver<span class="token punctuation">(</span></span><span class="token string">'github'</span><span class="token punctuation">)</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">user<span class="token punctuation">(</span></span><span class="token punctuation">)</span><span class="token punctuation">;</span>

       <span class="token comment" spellcheck="true"> // $user-&gt;token;
</span>    <span class="token punctuation">}</span>
<span class="token punctuation">}</span></code></pre>
<p>The <code class=" language-php">redirect</code> method takes care of sending the user to the OAuth provider, while the <code class=" language-php">user</code> method will read the incoming request and retrieve the user's information from the provider.</p>
<p>Of course, you will need to define routes to your controller methods:</p>
<pre class=" language-php"><code class=" language-php"><span class="token scope">Route<span class="token punctuation">::</span></span><span class="token function">get<span class="token punctuation">(</span></span><span class="token string">'login/github'</span><span class="token punctuation">,</span> <span class="token string">'Auth\LoginController@redirectToProvider'</span><span class="token punctuation">)</span><span class="token punctuation">;</span>
<span class="token scope">Route<span class="token punctuation">::</span></span><span class="token function">get<span class="token punctuation">(</span></span><span class="token string">'login/github/callback'</span><span class="token punctuation">,</span> <span class="token string">'Auth\LoginController@handleProviderCallback'</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
<p><a name="optional-parameters"></a></p>
<h2><a href="#optional-parameters">Optional Parameters</a></h2>
<p>A number of OAuth providers support optional parameters in the redirect request. To include any optional parameters in the request, call the <code class=" language-php">with</code> method with an associative array:</p>
<pre class=" language-php"><code class=" language-php"><span class="token keyword">return</span> <span class="token scope">Socialite<span class="token punctuation">::</span></span><span class="token function">driver<span class="token punctuation">(</span></span><span class="token string">'google'</span><span class="token punctuation">)</span>
    <span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">with<span class="token punctuation">(</span></span><span class="token punctuation">[</span><span class="token string">'hd'</span> <span class="token operator">=</span><span class="token operator">&gt;</span> <span class="token string">'example.com'</span><span class="token punctuation">]</span><span class="token punctuation">)</span>
    <span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">redirect<span class="token punctuation">(</span></span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
<blockquote class="has-icon">
<p class="note"><div class="flag"><span class="svg"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:a="http://ns.adobe.com/AdobeSVGViewerExtensions/3.0/" version="1.1" x="0px" y="0px" width="90px" height="90px" viewBox="0 0 90 90" enable-background="new 0 0 90 90" xml:space="preserve"><path fill="#FFFFFF" d="M45 0C20.1 0 0 20.1 0 45s20.1 45 45 45 45-20.1 45-45S69.9 0 45 0zM45 74.5c-3.6 0-6.5-2.9-6.5-6.5s2.9-6.5 6.5-6.5 6.5 2.9 6.5 6.5S48.6 74.5 45 74.5zM52.1 23.9l-2.5 29.6c0 2.5-2.1 4.6-4.6 4.6 -2.5 0-4.6-2.1-4.6-4.6l-2.5-29.6c-0.1-0.4-0.1-0.7-0.1-1.1 0-4 3.2-7.2 7.2-7.2 4 0 7.2 3.2 7.2 7.2C52.2 23.1 52.2 23.5 52.1 23.9z"></path></svg></span></div> When using the <code class=" language-php">with</code> method, be careful not to pass any reserved keywords such as <code class=" language-php">state</code> or <code class=" language-php">response_type</code>.</p>
</blockquote>
<p><a name="access-scopes"></a></p>
<h2><a href="#access-scopes">Access Scopes</a></h2>
<p>Before redirecting the user, you may also add additional "scopes" on the request using the <code class=" language-php">scopes</code> method. This method will merge all existing scopes with the ones you supply:</p>
<pre class=" language-php"><code class=" language-php"><span class="token keyword">return</span> <span class="token scope">Socialite<span class="token punctuation">::</span></span><span class="token function">driver<span class="token punctuation">(</span></span><span class="token string">'github'</span><span class="token punctuation">)</span>
    <span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">scopes<span class="token punctuation">(</span></span><span class="token punctuation">[</span><span class="token string">'read:user'</span><span class="token punctuation">,</span> <span class="token string">'public_repo'</span><span class="token punctuation">]</span><span class="token punctuation">)</span>
    <span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">redirect<span class="token punctuation">(</span></span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
<p>You can overwrite all existing scopes using the <code class=" language-php">setScopes</code> method:</p>
<pre class=" language-php"><code class=" language-php"><span class="token keyword">return</span> <span class="token scope">Socialite<span class="token punctuation">::</span></span><span class="token function">driver<span class="token punctuation">(</span></span><span class="token string">'github'</span><span class="token punctuation">)</span>
    <span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">setScopes<span class="token punctuation">(</span></span><span class="token punctuation">[</span><span class="token string">'read:user'</span><span class="token punctuation">,</span> <span class="token string">'public_repo'</span><span class="token punctuation">]</span><span class="token punctuation">)</span>
    <span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">redirect<span class="token punctuation">(</span></span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
<p><a name="stateless-authentication"></a></p>
<h2><a href="#stateless-authentication">Stateless Authentication</a></h2>
<p>The <code class=" language-php">stateless</code> method may be used to disable session state verification. This is useful when adding social authentication to an API:</p>
<pre class=" language-php"><code class=" language-php"><span class="token keyword">return</span> <span class="token scope">Socialite<span class="token punctuation">::</span></span><span class="token function">driver<span class="token punctuation">(</span></span><span class="token string">'google'</span><span class="token punctuation">)</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">stateless<span class="token punctuation">(</span></span><span class="token punctuation">)</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">user<span class="token punctuation">(</span></span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
<p><a name="retrieving-user-details"></a></p>
<h2><a href="#retrieving-user-details">Retrieving User Details</a></h2>
<p>Once you have a user instance, you can grab a few more details about the user:</p>
<pre class=" language-php"><code class=" language-php"><span class="token variable">$user</span> <span class="token operator">=</span> <span class="token scope">Socialite<span class="token punctuation">::</span></span><span class="token function">driver<span class="token punctuation">(</span></span><span class="token string">'github'</span><span class="token punctuation">)</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">user<span class="token punctuation">(</span></span><span class="token punctuation">)</span><span class="token punctuation">;</span>
<span class="token comment" spellcheck="true">
// OAuth Two Providers
</span><span class="token variable">$token</span> <span class="token operator">=</span> <span class="token variable">$user</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token property">token</span><span class="token punctuation">;</span>
<span class="token variable">$refreshToken</span> <span class="token operator">=</span> <span class="token variable">$user</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token property">refreshToken</span><span class="token punctuation">;</span><span class="token comment" spellcheck="true"> // not always provided
</span><span class="token variable">$expiresIn</span> <span class="token operator">=</span> <span class="token variable">$user</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token property">expiresIn</span><span class="token punctuation">;</span>
<span class="token comment" spellcheck="true">
// OAuth One Providers
</span><span class="token variable">$token</span> <span class="token operator">=</span> <span class="token variable">$user</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token property">token</span><span class="token punctuation">;</span>
<span class="token variable">$tokenSecret</span> <span class="token operator">=</span> <span class="token variable">$user</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token property">tokenSecret</span><span class="token punctuation">;</span>
<span class="token comment" spellcheck="true">
// All Providers
</span><span class="token variable">$user</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">getId<span class="token punctuation">(</span></span><span class="token punctuation">)</span><span class="token punctuation">;</span>
<span class="token variable">$user</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">getNickname<span class="token punctuation">(</span></span><span class="token punctuation">)</span><span class="token punctuation">;</span>
<span class="token variable">$user</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">getName<span class="token punctuation">(</span></span><span class="token punctuation">)</span><span class="token punctuation">;</span>
<span class="token variable">$user</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">getEmail<span class="token punctuation">(</span></span><span class="token punctuation">)</span><span class="token punctuation">;</span>
<span class="token variable">$user</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">getAvatar<span class="token punctuation">(</span></span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
<h4>Retrieving User Details From A Token (OAuth2)</h4>
<p>If you already have a valid access token for a user, you can retrieve their details using the <code class=" language-php">userFromToken</code> method:</p>
<pre class=" language-php"><code class=" language-php"><span class="token variable">$user</span> <span class="token operator">=</span> <span class="token scope">Socialite<span class="token punctuation">::</span></span><span class="token function">driver<span class="token punctuation">(</span></span><span class="token string">'github'</span><span class="token punctuation">)</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">userFromToken<span class="token punctuation">(</span></span><span class="token variable">$token</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
<h4>Retrieving User Details From A Token And Secret (OAuth1)</h4>
<p>If you already have a valid pair of token / secret for a user, you can retrieve their details using the <code class=" language-php">userFromTokenAndSecret</code> method:</p>
<pre class=" language-php"><code class=" language-php"><span class="token variable">$user</span> <span class="token operator">=</span> <span class="token scope">Socialite<span class="token punctuation">::</span></span><span class="token function">driver<span class="token punctuation">(</span></span><span class="token string">'twitter'</span><span class="token punctuation">)</span><span class="token operator">-</span><span class="token operator">&gt;</span><span class="token function">userFromTokenAndSecret<span class="token punctuation">(</span></span><span class="token variable">$token</span><span class="token punctuation">,</span> <span class="token variable">$secret</span><span class="token punctuation">)</span><span class="token punctuation">;</span></code></pre>
	</article>
